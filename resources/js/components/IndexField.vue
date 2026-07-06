<template>
    <div>
        <popper hover :content="getTooltip()" :style="[getBackgroundStyle(), getTextColorStyle()]">
            <StatusIcon :solid="field.solid_icon" :name="getValue()" :class="getColor()" />
        </popper>
    </div>
</template>

<script>
import StatusIcon from './StatusIcon'

export default {
    components: { StatusIcon },
    props: ['resourceName', 'field'],
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
        },
        getColor: function() {
            if (this.field.color) {
                if (typeof this.field.color == "string") return 'text-' + this.field.color;
                else return 'text-' + this.field.color[this.getValue()];
            }
        },
        getBackgroundStyle: function() {
            if (!this.field.background) return {};
            const color = (typeof this.field.background == "string")
                ? this.field.background
                : this.field.background[this.getValue()];
            if (!color) return {};
            return {
                '--popper-theme-background-color': color,
                '--popper-theme-background-color-hover': color,
            };
        },
        getTextColorStyle: function() {
            if (!this.field.text_color) return {};
            const color = (typeof this.field.text_color == "string")
                ? this.field.text_color
                : this.field.text_color[this.getValue()];
            if (!color) return {};
            return { '--nsf-popper-text-color': color };
        },
    }
}
</script>