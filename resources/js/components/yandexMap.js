let scriptPromise = null;

function loadYandexMaps(apikey) {
    if (window.ymaps) {
        return Promise.resolve(window.ymaps);
    }

    if (!scriptPromise) {
        scriptPromise = new Promise((resolve, reject) => {
            const params = new URLSearchParams({ lang: "ru_RU" });
            if (apikey) {
                params.set("apikey", apikey);
            }

            const script = document.createElement("script");
            script.src = `https://api-maps.yandex.ru/2.1/?${params.toString()}`;
            script.async = true;
            script.onload = () => resolve(window.ymaps);
            script.onerror = reject;
            document.head.appendChild(script);
        });
    }

    return scriptPromise;
}

export default function yandexMap({ lat, lng, apikey }) {
    // Экземпляр карты и ResizeObserver держим вне возвращаемого объекта —
    // Alpine оборачивает x-data в глубокий reactive-прокси, а внутренние
    // методы Яндекс.Карт ожидают «сырой» this и ломаются на прокси
    // (например, их собственный внутренний таймер ресайза кидает
    // "Cannot read properties of undefined" при обращении к приватному
    // состоянию через прокси-обёртку).
    let map = null;
    let resizeObserver = null;

    return {
        open: true,
        mapFailed: false,

        init() {
            loadYandexMaps(apikey)
                .then((ymaps) => {
                    ymaps.ready(() => {
                        map = new ymaps.Map(this.$refs.map, {
                            center: [lat, lng],
                            zoom: 16,
                            controls: ["zoomControl"],
                        });

                        const placemark = new ymaps.Placemark([lat, lng], {}, {
                            preset: "islands#redIcon",
                        });

                        placemark.events.add("click", () => {
                            this.open = true;
                        });

                        map.geoObjects.add(placemark);

                        // Контейнер карты не отслеживает своё изменение размера сам
                        // (например, когда соседний блок формы меняет высоту после
                        // успешной отправки) — без этого тайлы могут остаться
                        // смещёнными/неполными.
                        resizeObserver = new ResizeObserver(() => {
                            map?.container.fitToViewport();
                        });
                        resizeObserver.observe(this.$refs.map);
                    });
                })
                .catch((error) => {
                    console.error("Не удалось загрузить Яндекс.Карты", error);
                    this.mapFailed = true;
                });
        },

        destroy() {
            resizeObserver?.disconnect();
            map?.destroy();
        },
    };
}
