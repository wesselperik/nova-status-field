<template>
    <div class="flex border-b border-40">
        <div class="w-1/4 py-4">
            <h4 class="font-normal text-80">{{ field.name }}</h4>
        </div>
        <div class="w-3/4 py-4 break-words">
            <component :is="getValue()" />
        </div>
    </div>
</template>

<script>
import * as components from './icons'

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
