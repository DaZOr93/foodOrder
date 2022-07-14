<template>
    <div class='v-notification'>
        <transition-group
            name="v-transition-animate"
            class="messages_list"
        >
            <div
                class="v-notification__content"
                v-for="message in stateNotification"
                :key="message.id"
                :class="message.icon"
            >
                <div class="content__text">
                    <span>{{message.name}}</span>
                </div>
            </div>
        </transition-group>
    </div>
</template>

<script>
import {mapGetters, mapMutations, mapActions} from 'vuex';
export default {
    name: "v-notification",
    props: {

        timeout: {
            type: Number,
            default: 3000
        }
    },
    data() {
        return {}
    },
    methods: {
        ...mapMutations(['deleteNotification']),
        hideNotification() {
            let vm = this;
            if (this.stateNotification.length) {
                setTimeout(function () {
                    vm.deleteNotification()
                }, vm.timeout)
            }
        }
    },
    computed: {
        ...mapGetters(['stateNotification']),

    },
    watch: {
        stateNotification() {
            this.hideNotification()
        }
    },
    mounted() {
        this.hideNotification()
    }
}
</script>

<style lang="scss">
.v-notification {
    position: fixed;
    top: 80px;
    right: 16px;
    z-index: 10;
    &__messages_list {
        display: flex;
        flex-direction: column-reverse;
    }
    &__content {
        padding: 16px;
        border-radius: 4px;
        color: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 50px;
        margin-bottom: 16px;
        background: green;
        &.error {
            background: red;
        }
        &.warning {
            background: orange;
        }
        &.check_circle {
            background: green;
        }
    }
    .content {
        &__text {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    }
    .material-icons {
        margin-left: 16px;
    }
}
.v-transition-animate {
    &-enter {
        transform: translateX(120px);
        opacity: 0;
    }
    &-enter-active {
        transition: all .6s ease;
    }
    &-enter-to {
        opacity: 1;
    }
    &-leave {
        height: 50px;
        opacity: 1;
    }
    &-leave-active {
        transition: transform .6s ease, opacity .6s, height .6s .2s;
    }
    &-leave-to {
        height: 0;
        transform: translateX(120px);
        opacity: 0;
    }
    &-move {
        transition: transform .6s ease;
    }
}
</style>
