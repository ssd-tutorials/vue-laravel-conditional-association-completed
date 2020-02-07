<template>
    <svg class="fill-current h-3.5 w-3.5 inline-block mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448">
        <path v-if="checked" d="M400 0H48A48 48 0 000 48v352a48 48 0 0048 48h352a48 48 0 0048-48V48a48 48 0 00-48-48zm0 400H48V48h352v352zm-35.9-241.7L191.5 329.5a12 12 0 01-17-.1l-90.8-91.5a12 12 0 01.1-17l22.7-22.5a12 12 0 0117 .1l59.8 60.3 141.4-140.2a12 12 0 0117 .1l22.5 22.7a11.9 11.9 0 01-.1 16.9z"/>
        <path v-else d="M400 0H48A48 48 0 000 48v352a48 48 0 0048 48h352a48 48 0 0048-48V48a48 48 0 00-48-48zm-6 400H54a6 6 0 01-6-6V54a6 6 0 016-6h340a6 6 0 016 6v340a6 6 0 01-6 6z"/>
    </svg>
</template>
<script>
    export default {
        props: {
            checked: {
                type: Boolean,
                default: false
            }
        }
    }
</script>
