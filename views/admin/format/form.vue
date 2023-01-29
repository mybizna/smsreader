<template>
    <table-edit :path_param="path_param" :model="model">

        <div class="row">
            <div class="col-md-6">
                <FormKit v-model="model.id" label="Id" id="id" type="hidden" validation="required" />
                <FormKit v-model="model.title" label="Title" id="title" type="text" validation="required" />
                <FormKit v-model="model.format" label="Format" id="format" type="text" validation="required" />
                <FormKit v-model="model.fields_str" label="Dields Str" id="fields_str" type="text" validation="required" />
                <FormKit v-model="model.published" label="Published" id="published" type="text" validation="required" />
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
            path_param: ["smsreader", "format"],
            model: {
                id: "",
                title: "",
                format: "",
                fields_str: "",
                published: "",
            },

        };

    }
};
</script>
