<template>
    <component :is="iconComponent" v-bind="iconProps" />
</template>

<script>
import { resolveComponent } from 'vue'

// Heroicons v1 names (Nova 4) that were renamed in Heroicons v2 (Nova 5).
const heroiconsV2Aliases = {
    'info-circle': 'information-circle',
}

export default {
    props: {
        name: {
            type: String,
            default: '',
        },
        solid: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        isNova5() {
            return typeof window.LaravelNovaUi !== 'undefined'
        },
        iconComponent() {
            return this.isNova5 ? window.LaravelNovaUi.Icon : resolveComponent('Icon')
        },
        iconProps() {
            if (this.isNova5) {
                return {
                    name: heroiconsV2Aliases[this.name] || this.name,
                    type: this.solid ? 'solid' : 'outline',
                }
            }

            return {
                type: this.name,
                solid: this.solid,
            }
        },
    },
}
</script>
