    Vue.createApp({
        data() {
            return {
                num_contract: ''
            }
        },
        methods: {
            getSale: function() {
                alert(this.num_contract)
            }
        },
    }).mount('#app')