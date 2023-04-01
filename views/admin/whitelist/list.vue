
<template>
    <table-render :path_param="['smsreader', 'whitelist']" title="SMS Reader Whitelist" :table_fields="table_fields">

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
