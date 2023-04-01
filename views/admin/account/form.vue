<template>
    <edit-render :path_param="['smsreader', 'account']" :model="model">

        <div class="row">
            <div class="col-md-6">
                <FormKit v-model="model.id" label="Id" id="id" type="hidden" validation="required" />
                <FormKit v-model="model.partner_id" label="Partner" id="partner_id" type="text" validation="required" />
                <FormKit v-model="model.txn" label="TXN" id="txn" type="text" validation="required" />
                <FormKit v-model="model.account" label="Account" id="account" type="text" validation="required" />
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
                partner_id: "",
                txn: "",
                account: "",
            },
            
        };

    }
};
</script>
