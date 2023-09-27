<template>
    <div>
        {{ value }}
    </div>
</template>

<script>
export default {
    props: ['field', 'resourceName', 'resourceId', 'value'],
}
</script>
