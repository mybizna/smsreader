<template>
    <customform></customform>
</template>

<script>
export default {
    components: {
        customform: window.$func.fetchComponent(["smsreader", "format", "form.vue"])
    },
};
</script>
