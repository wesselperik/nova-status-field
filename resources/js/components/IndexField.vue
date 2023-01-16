<template>
        <div v-if="field.info && field.info_on_index">
            <popper hover placement="right" :content="getTooltip()" v-if="field.display_tooltip">
                <Icon :solid="this.field.solid_icon" :type="getValue()" :class="getColor()" />
            </popper>
            <Icon :solid="this.field.solid_icon" :type="getValue()" :class="getColor()" v-else />
            <span class="text-90 ml-2">{{ getInfo() }}</span>
        </div>
        <popper hover placement="right" :content="getTooltip()" v-else>
            <Icon :solid="this.field.solid_icon" :type="getValue()" :class="getColor()" />
        </popper>
</template>

<script>
import { initCustomFormatter } from 'vue';

export default {
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
        getInfo: function() {
            if (this.field.info) {
                const maxlength = this.field.info_on_index_maxlength;
                let info = (typeof this.field.info == "string")?this.field.info:this.field.info[this.getValue()];
                return info.length<=maxlength?info:info.substring(0, maxlength)+'...';
            }
        },
        getColor: function() {
            if (this.field.color) {
                if (typeof this.field.color == "string") return 'text-' + this.field.color;
                else return 'text-' + this.field.color[this.getValue()];
            }
        },
    }
}
</script>
