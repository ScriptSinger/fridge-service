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
    return {
        open: true,

        init() {
            loadYandexMaps(apikey).then((ymaps) => {
                ymaps.ready(() => {
                    const map = new ymaps.Map(this.$refs.map, {
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
                });
            });
        },
    };
}
