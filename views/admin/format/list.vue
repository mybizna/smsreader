
<template>
    <table-list title="SMS Reader Format" :path_param="path_param" :search_fields="search_fields" :model="model"
        :table_fields="table_fields"></table-list>
</template>

<script>

export default {
    components: {
        TableList: window.$func.fetchComponent("components/common/TableList.vue")
    },
    data () {
        return {
            path_param: ["smsreader", "format"],
            model: {
                id: "",
                title: "",
                format: "",
                fields_str: "",
                published: "",
            },
            search_fields: [
                { type: "text", name: "title", label: "Title", ope: "", },
                { type: "text", name: "format", label: "Format", ope: "", },
                { type: "text", name: "fields_str", label: "Fields Str", ope: "", },
                { type: "text", name: "published", label: "Published", ope: "", },
            ],
            table_fields: [
                { text: "Title", prop: "title", name: "title", },
                { text: "Format", prop: "format", name: "format", },
                { text: "Fields Str", prop: "fields_str", name: "fields_str", },
                { text: "Published", prop: "published", name: "published", },
            ],
        };
    }
};
</script>
