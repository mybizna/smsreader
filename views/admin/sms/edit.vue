<template>
    <customform></customform>
</template>

<script>
export default {
    components: {
        customform: window.$func.fetchComponent(["smsreader", "sms", "form.vue"])
    },
};
</script>
