{{-- Business that a Review/AggregateRating is about (microdata itemReviewed).
     Same type as the JSON-LD business: config('contacts.schema_business_type'). --}}
<div itemprop="itemReviewed" itemscope itemtype="https://schema.org/{{ config('contacts.schema_business_type') }}">
    <meta itemprop="name" content="{{ config('contacts.business_name') }}">
    <meta itemprop="telephone" content="{{ config('contacts.phone_tel') }}">
    <meta itemprop="address" content="{{ config('contacts.address_full') }}">
</div>
