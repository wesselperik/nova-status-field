<template>
    <td style="border: 0;">
        <div class="text-center">
            <div v-for="(value, key) in field.values" :key="key">
            <Active v-if="key == 'active' && value" />
            <Inactive v-if="key == 'inactive' && value" />
            <Pending v-if="key == 'pending' && value" />
            <Warning v-if="key == 'warning' && value" />
            <Info v-if="key == 'info' && value" />
            <Help v-if="key == 'help' && value" />
            </div>
        </div>
    </td>
</template>

<script>
import Active from './icons/Active.vue';
import Inactive from './icons/Inactive.vue';
import Pending from './icons/Pending.vue';
import Warning from './icons/Warning.vue';
import Info from './icons/Info.vue';
import Help from './icons/Help.vue';

export default {
    props: ['resourceName', 'field'],

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
