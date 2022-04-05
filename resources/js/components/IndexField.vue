<template>
    <div class="flex text-left">
        <popper hover :content="getTooltip()">
            <component :is="getValue()" />
        </popper>
    </div>
</template>

<script>
import * as components from './icons'

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
