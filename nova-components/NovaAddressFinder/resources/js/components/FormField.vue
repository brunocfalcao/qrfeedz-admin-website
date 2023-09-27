<template>
    <div>
        <div id="pac-card">
            <input id="pac-input" type="text" placeholder="Enter a location">
        </div>
        <div id="map" style="height: 400px;"></div>
        <div id="infowindow-content">
            <span id="place-name"></span>
            <span id="place-address"></span>
        </div>
        <input type="hidden" :name="field.attribute" :value="address">
    </div>
</template>

<script>
export default {
    props: ['field', 'resourceName', 'resourceId'],
    data: () => ({
        address: null,
    }),
    mounted() {
        const apiKey = Nova.config('googleMapsApiKey');
        this.loadGoogleMapsScript(apiKey).then(() => {
            this.initMap();
        });
    },
    methods: {
        loadGoogleMapsScript(apiKey) {
            return new Promise((resolve) => {
                const script = document.createElement('script');
                script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places`;
                script.onload = resolve;
                document.head.appendChild(script);
            });
        },
        initMap() {
            // Your map initialization logic here...
            // Adapt the provided JavaScript code to work within this Vue method
        }
    },
}
</script>

<style>
/* Your custom styles */
</style>
