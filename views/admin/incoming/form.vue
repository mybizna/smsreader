<template>
    <edit-render :path_param="['smsreader', 'incoming']" :model="model">

        <div class="row">
            <div class="col-md-6">
                <FormKit v-model="model.id" label="Id" id="id" type="hidden" validation="required" />
                <FormKit v-model="model.phone" label="Phone" id="phone" type="text" validation="required" />
                <FormKit v-model="model.message" label="Message" id="message" type="textarea" validation="required" />
                <FormKit v-model="model.date_sent" label="Date Sent" id="date_sent" type="text" validation="required" />
            </div>
            <div class="col-md-6">
                <FormKit v-model="model.gateway_id" label="Gateway" id="gateway_id" type="recordselect"
                    :setting="setting.gateway_id" validation="required" />
                <FormKit v-model="model.completed" type="switch" label="Completed" id="completed" validation="required" />
                <FormKit v-model="model.successful" type="switch" label="Successful" id="successful"
                    validation="required" />
            </div>
            <div class="col-md-12">
                <FormKit v-model="model.params" label="Params" id="params" type="textarea" validation="required" />
            </div>
        </div>

    </edit-render>
</template>
<script>
export default {
    data() {
        return {
            id: null,
            setting: {
                gateway_id: {
                    path_param: ["account", "gateway"],
                    fields: ['title',],
                    template: '[title]'
                },
            },
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
