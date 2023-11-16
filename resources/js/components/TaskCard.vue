<template>
    <div class="w-full text-gray-900 shadow-md rounded-lg p-3 pb-8 mb-4 relative"
        :class="{
            'bg-gray-500': task.completed_at,
            'bg-white': !task.completed_at,
        }"
        @mouseenter="kanban.hoveredName = task.name"
        @mouseleave="kanban.unhoverTask()"
        @click="kanban.selectTask(task)"
    >
        <FlagIcon class="w-7 h-7 absolute top-0 right-0 bg-red-500 text-white px-2 rounded" v-if="isDueTask"/>
        {{ task.name }}<br>
        <div class="text-xs text-gray-500 absolute bottom-2 ">{{ task.user.name }}</div>
        <img class="w-10 h-10 shadow-lg rounded-full absolute bottom-0 right-0 -mr-2 -mb-2 border-2 border-white"
            :src="getAvatar()" :alt="task.user.name" />
    </div>
</template>

<script setup>
// get the props
import { computed } from 'vue';
import { useKanbanStore } from '../stores/kanban';
import { sha256 } from 'js-sha256';
import { FlagIcon } from '@heroicons/vue/20/solid'
const kanban = useKanbanStore()

const isDueTask = computed(() => {
    const currentDate = new Date()
    const taskDueDate = new Date(props.due_date)

    return taskDueDate < currentDate
})
const getAvatar = function (user) {
    if (user.profile_picture_url === null) {
        return ("https://www.gravatar.com/avatar/" + sha256(String(user.email).trim().toLowerCase()) + "?size=400");
    }
    return user.profile_picture_url
}

const props = defineProps({
    task: {
        type: Object,
        required: true
    }
})
</script>
