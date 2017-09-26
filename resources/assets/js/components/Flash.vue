<template>
    <div :class="classes" role="alert" v-show="show">
        {{ body }}
    </div>
</template>

<script>
    export default {
        props: ['message', 'type'],
        data() {
            return {
                body: '',
                type: '',
                show: false
            }
        },
        created() {
            if(this.message) {
                this.flash(this.message, this.type);
            }

            window.events.$on('flash', message => this.flash(message));
        },
        computed: {
            classes() {
                return [
                    'alert',
                    'alert-flash',
                    'alert-' + this.type
                ];
            }
        },
        methods: {
            flash(message, type) {
                this.body = message;
                this.type = type;
                this.show = true;

                this.hide();
            },
            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    };
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>
