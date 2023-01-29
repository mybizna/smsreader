<template>
    <table-edit :path_param="path_param" :model="model">

        <div class="row">
            <div class="col-md-6">
                <FormKit v-model="model.id" label="Id" id="id" type="hidden" validation="required" />
                <FormKit v-model="model.phone" label="Phone" id="phone" type="text" validation="required" />
                <FormKit v-model="model.message" label="Message" id="message" type="text" validation="required" />
                <FormKit v-model="model.date_sent" label="Date Sent" id="date_sent" type="text" validation="required" />
                <FormKit v-model="model.params" label="Params" id="params" type="text" validation="required" />
                <FormKit v-model="model.gateway_id" label="Gateway" id="gateway_id" type="text" validation="required" />
                <FormKit v-model="model.completed" label="Completed" id="completed" type="text" validation="required" />
                <FormKit v-model="model.successful" label="Successful" id="successful" type="text" validation="required" />
            </div>
            <div class="col-md-6">

            </div>
        </div>

    </table-edit>
</template>
<script>
export default {
    components: {
        TableEdit: window.$func.fetchComponent("components/common/TableEdit.vue")
    },
    data () {
        return {
            id: null,
            path_param: ["smsreader", "sms"],
            model: {
                id: "",
                phone: "",
                message: "",
                date_sent: "",
                params: "",
                gateway_id: "",
                completed: "",
                successful: "",
            },

        };

    }
};
</script>
