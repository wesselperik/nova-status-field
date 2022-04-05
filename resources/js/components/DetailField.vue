<template>
    <PanelItem :index="index" :field="field">
        <template v-slot:value>
            <div v-if="!field.info" class="field">
                <popper hover placement="right" :content="getTooltip()">
                    <component :is="getValue()" />
                </popper>
            </div>
            <div v-else class="field">
                <popper hover placement="right" :content="getTooltip()" v-if="field.display_tooltip">
                    <component :is="getValue()" />
                </popper>
                <component :is="getValue()" v-else />
                <p class="text-90 ml-2">{{ getInfo() }}</p>
            </div>
        </template>
    </PanelItem>
</template>
<style lang="scss" scoped>
    // svg {
    //     height: 24px;
    //     top: -2px;
    //     position: relative;
    // }
</style>
<script>
import * as components from './icons'

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    components,
    methods: {
        getValue: function() {
            if (!this.field.values) return this.field.value;
            return Object.keys(this.field.values).filter(k => this.field.values[k])[0];
        },
        getTooltip: function() {
            if (this.field.tooltip) {
                if (typeof this.field.tooltip == "string") return this.field.tooltip;
                else return this.field.tooltip[this.getValue()];
            }
        },
        getInfo: function() {
            if (this.field.info) {
                if (typeof this.field.info == "string") return this.field.info;
                else return this.field.info[this.getValue()];
            }
        }
    }
}
</script>
