<template>
    <edit-render :path_param="['smsreader', 'blacklist']" :model="model">

        <div class="row">
            <div class="col-md-6">
                <FormKit v-model="model.id" label="Id" id="id" type="hidden" validation="required" />
                <FormKit v-model="model.sender" label="Sender" id="sender" type="text" validation="required" />
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
                sender: "",
            },

        };

    }
};
</script>
