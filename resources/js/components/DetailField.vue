<template>
    <PanelItem :index="index" :field="field">
        <template v-slot:value>
            <div v-if="!field.info" class="field">
                <popper hover placement="right" :content="getTooltip()">
                    <Icon :solid="this.field.solid_icon" :type="getValue()" :class="getColor()" />
                </popper>
            </div>
            <div v-else class="field">
                <popper hover placement="right" :content="getTooltip()" v-if="field.display_tooltip">
                    <Icon :solid="this.field.solid_icon" :type="getValue()" :class="getColor()" />
                </popper>
                <Icon :solid="this.field.solid_icon" :type="getValue()" :class="getColor()" v-else />
                <p class="text-90 ml-2">{{ getInfo() }}</p>
            </div>
        </template>
    </PanelItem>
</template>
<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
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
