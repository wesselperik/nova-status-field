<template>
    <div class="flex border-b border-40">
        <div class="w-1/4 py-4">
            <h4 class="font-normal text-80">{{ field.name }}</h4>
        </div>
        <div class="w-3/4 py-4 break-words">
            <div class="component-wrapper" v-tooltip="{'content': field.tooltip, 'placement': 'top'}" v-if="!field.info">
                <component :is="getValue()" />
            </div>
            <template v-else>
                <div class="info">
                    <div class="component-wrapper" v-tooltip="{'content': field.tooltip, 'placement': 'top'}" v-if="field.display_tooltip">
                        <component :is="getValue()" />
                    </div>
                    <component :is="getValue()" v-else />
                    <span class="pl-2">{{ field.info }}</span>
                </div>
            </template>
        </div>
    </div>
</template>
<style lang="scss" scoped>
    .component-wrapper {
        display: inline-block;
        height: 24px;
    }
    .info {
        display: flex;
        align-items: center;

        span {
            margin-top: 2px;
        }

        svg {
            overflow: unset;
        }
    }
</style>
<script>
import * as components from './icons'
import VTooltip from 'v-tooltip'

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    components,
    methods: {
        getValue: function() {
            if (!this.field.values) return this.field.value;
            return Object.keys(this.field.values).filter(k => this.field.values[k])[0];
        }
    }
}
</script>
