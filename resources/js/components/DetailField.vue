<template>
    <div class="flex border-b border-40">
        <div class="w-1/4 py-4">
            <h4 class="font-normal text-80">{{ field.name }}</h4>
        </div>
        <div class="w-3/4 py-4 break-words">
            <div v-for="(value, key) in field.values" :key="key">
                <Active v-if="key == 'active' && value" />
                <Inactive v-if="key == 'inactive' && value" />
                <Pending v-if="key == 'pending' && value" />
                <Warning v-if="key == 'warning' && value" />
                <Info v-if="key == 'info' && value" />
                <Help v-if="key == 'help' && value" />
            </div>
        </div>
    </div>
</template>

<script>
import Active from './icons/Active.vue';
import Inactive from './icons/Inactive.vue';
import Pending from './icons/Pending.vue';
import Warning from './icons/Warning.vue';
import Info from './icons/Info.vue';
import Help from './icons/Help.vue';

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    components: {
        Active,
        Inactive,
        Pending,
        Warning,
        Info,
        Help
    }
}
</script>
