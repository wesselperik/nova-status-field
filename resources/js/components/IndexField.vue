<template>
    <td style="border: 0;">
        <div class="text-center" v-tooltip="{'content': field.tooltip, 'placement': 'top'}">
            <component :is="getValue()" />
        </div>
    </td>
</template>

<script>
import * as components from './icons'
import VTooltip from 'v-tooltip'

export default {
    props: ['resourceName', 'field'],
    components,
    methods: {
        getValue: function() {
            if (!this.field.values) return this.field.value;
            return Object.keys(this.field.values).filter(k => this.field.values[k])[0];
        }
    }
}
</script>
