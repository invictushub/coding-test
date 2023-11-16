<template>
<div class="w-[300px] bg-sky-950 rounded-lg shadow-lg">
    <div class="p-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg text-zinc-100 font-black mb-3">{{ kanban.phases[props.phase_id].name }} - {{ kanban.phases[props.phase_id].tasks_count }}</h2>
            </div>
            <div class="flex">
                <PlusIcon
                    @click="createTask()"
                    class="mb-3 h-6 w-6 text-white hover:cursor-pointer"
                    aria-hidden="true" />
                <TrashIcon
                    @click="deletePhase()"
                    class="mb-3 ml-2 h-5 w-5 text-white hover:cursor-pointer"
                    aria-hidden="true" />
            </div>
        </div>
        <task-card v-if="kanban.phases[props.phase_id].tasks.length > 0" v-for="task in kanban.phases[props.phase_id].tasks" :task="task" />

        <!-- A card to create a new task -->
        <div class="w-full flex items-center justify-between bg-white text-gray-900 hover:cursor-pointer shadow-md rounded-lg p-3 relative"
            @click="createTask()">
            <span>Create a new task</span>
            <PlusIcon class="h-6 w-6" aria-hidden="true" />
        </div>

    </div>
</div>
</template>

<script setup>
// get the props
import { useKanbanStore } from '../stores/kanban'
import { PlusIcon, TrashIcon } from '@heroicons/vue/20/solid'
const emit = defineEmits(['refreshBoard'])
const kanban = useKanbanStore()

const props = defineProps({
    phase_id: {
        type: Number,
        required: true
    },
})

const createTask = function () {
    kanban.creatingTask = true;
    kanban.creatingTaskProps.phase_id = props.phase_id;
}

const deletePhase = async () => {
    try {
        if (confirm('Are you sure to want to delete this phase?')) {
            const response = await axios.delete(`/api/phases/${props.phase_id}`)
            emit('refreshBoard')
        }
    } catch (error) {
        console.error('There was an error fetching the tasks!', error);
    }
}
</script>
