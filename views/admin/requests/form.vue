<template>
    <edit-render :path_param="['smsreader', 'requests']" :model="model">
        
        <div class="row">
            <div class="col-md-6">
                <FormKit v-model="model.id" label="Id" id="id" type="hidden" validation="required" />
                <FormKit v-model="model.payment_id" label="Payment" id="payment_id" type="text" validation="required" />
                <FormKit v-model="model.phone" label="Phone" id="phone" type="text" validation="required" />
                <FormKit v-model="model.message" label="Message" id="message" type="text" validation="required" />
                <FormKit v-model="model.date_sent" label="Date Sent" id="date_sent" type="text" validation="required" />
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
                payment_id: "",
                phone: "",
                message: "",
                date_sent: "",
            },

            

        };

    }
};
</script>
