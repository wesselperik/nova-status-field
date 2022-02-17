<template>
    <td style="border: 0;">
        <div class="text-center" v-tooltip="{'content': getTooltip(), 'placement': 'top'}">
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
            return Object.keys(this.field.values).filter(val => this.field.values[val])[0];
        },
        getTooltip: function() {
            if (this.field.tooltip) {
                if (typeof this.field.tooltip == "string") return this.field.tooltip;
                else return this.field.tooltip[this.getValue()];
            }
        }
    }
}
</script>
