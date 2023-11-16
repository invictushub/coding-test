<template>
<div class="max-w-7xl flex-1 mx-auto flex flex-col overflow-auto sm:px-6 lg:px-8">
    <table class="w-full rtl:text-right">
        <thead class="text-xs text-white uppercase bg-gray-50 dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Total Tasks</th>
                <th scope="col" class="px-6 py-3">Tasks Completed Current Week</th>
                <th scope="col" class="px-6 py-3">Tasks Completed Current Month</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                    {{ user.name }}
                </th>
                <td class="px-6 py-4 text-center">
                    {{ user.tasks_count }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ user.current_week_completed_tasks_count }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ user.current_month_completed_tasks_count }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>
<script setup>
import { onMounted, ref } from "vue";
const users = ref([])

onMounted( async () => {
    const response = await axios.get('/api/users/stats')
    users.value = response.data
})
</script>
