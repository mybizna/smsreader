
<template>
    <table-render :path_param="['smsreader', 'template']" title="SMS Reader Template" :table_fields="table_fields">

        <template #header>
            <th-render>Title</th-render>
            <th-render>Slug</th-render>
            <th-render>Template</th-render>
            <th-render>Published</th-render>
        </template>

        <template #body="{ item }">
            <td>{{ item.title }}</td>
            <td>{{ item.slug }}</td>
            <td>{{ item.template }}</td>
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
            table_fields: ['title', 'slug', 'template', 'published'],
        };
    }
};
</script>
