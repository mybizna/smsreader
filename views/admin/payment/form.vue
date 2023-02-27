<template>
    <edit-render :path_param="['smsreader', 'payment']" :model="model">

        <div class="row">
            <div class="col-md-6">
                <FormKit v-model="model.id" label="Id" id="id" type="hidden" validation="required" />
                <FormKit v-model="model.phone" label="Phone" id="phone" type="text" validation="required" />
                <FormKit v-model="model.code" label="Code" id="code" type="text" validation="required" />
                <FormKit v-model="model.name" label="Name" id="name" type="text" validation="required" />
                <FormKit v-model="model.format_id" label="Format" id="format_id" type="text" validation="required" />
                <FormKit v-model="model.sms_id" label="Sms" id="sms_id" type="text" validation="required" />
                <FormKit v-model="model.partner_id" label="Partner" id="partner_id" type="text" validation="required" />
                <FormKit v-model="model.amount" label="Amount" id="amount" type="text" validation="required" />
                <FormKit v-model="model.account" label="Account" id="account" type="text" validation="required" />
                <FormKit v-model="model.date_sent" label="Date Sent" id="date_sent" type="text" validation="required" />
                <FormKit v-model="model.completed" label="Completed" id="completed" type="text" validation="required" />
                <FormKit v-model="model.successful" label="Successful" id="successful" type="text" validation="required" />
            </div>
            <div class="col-md-6">

            </div>
        </div>

    </edit-render>
</template>
<script>
export default {
    data () {
        return {
            id: null,
            model: {
                id: "",
                phone: "",
                code: "",
                name: "",
                format_id: "",
                sms_id: "",
                partner_id: "",
                amount: "",
                account: "",
                date_sent: "",
                completed: "",
                successful: "",
            },

        };

    }
};
</script>
