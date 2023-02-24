
<template>
    <table-render :path_param="['smsreader', 'format']" title="SMS Reader Format" :table_fields="table_fields">

        <template #header>
            <th-render>Title</th-render>
            <th-render>Format</th-render>
            <th-render>Fields Str</th-render>
            <th-render>Published</th-render>
        </template>

        <template #body="{ item }">
            <td>{{ item.title }}</td>
            <td>{{ item.format }}</td>
            <td>{{ item.fields_str }}</td>
            <td class="text-center">
                <btn-status :status="item.published"></btn-status>
            </td>
        </template>

    </table-render>
</template>

<script>

export default {
    data() {
        return {
            table_fields: ['title', 'format', 'fields_str', 'published'],

        };
    }
};
</script>
