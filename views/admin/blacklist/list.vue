
<template>
    <table-render :path_param="['smsreader', 'blacklist']" title="SMS Reader Blacklist" :table_fields="table_fields"
        :setting="{ hide_delete_button: true }">

        <template #header>
            <th-render>Sender</th-render>
        </template>

        <template #body="{ item }">
            <td>{{ item.sender }}</td>
        </template>

    </table-render>
</template>

<script>

export default {
    data() {
        return {
            table_fields: ['sender'],
        };
    }
};
</script>
