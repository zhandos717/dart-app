
"use strict";
var nsReport = new Vue({
    el: "#js-ns-report",
    data:{
    activeTab : 0,
    winners: [ ],
    winner_alert: {},
    notified: false,
    message:[]
    },
    methods: {
        toExcel: function() {
            var workbook = XLSX.utils.table_to_book(document.getElementById('zero-conf'));
            XLSX.writeFile(workbook, document.title+'.xlsx');
        },
        toExcel2: function() {
            var workbook = XLSX.utils.table_to_book(document.getElementById('js_table'));
            XLSX.writeFile(workbook, 'Победители.xlsx');
        },
       openWinners(id){
            this.winner_alert = {};
            axios.post('winner', {id:id})
            .then(response => {
                 this.winners =response.data
            })
            .catch(error => {
            console.log(error)
            this.errored = true
            })
        },
        sendMessage(val){
 
            axios.post('winner', {user_id:val})
            .then(response => {
               console.log(response)
                this.winner_alert= response.data;
                this.notified  = true;
                this.winner[val].notified = 'Да';
            })
            .catch(error => {
            console.log(error)
            this.errored = true
            })            
        },
        approve(event){
            this.winner_alert = {};
            var obj ={id_winner:event.target.dataset.id,
                    value_selected:event.target.value};
            axios.post('winner', obj)
            .then(response => {
                this.winner_alert= response.data,
                console.log(response.data)
            })
            .catch(error => {
            console.log(error)
            this.errored = true
            })
        },
        edit_message(id){
            this.message = {};
            axios.post(window.location.pathname, {id:id})
            .then(response => {
                // console.log(response.data.message)
                this.message =response.data.message
            })
            .catch(error => {
            console.log(error)
            this.errored = true
            })
        },
        add_message(){
             this.message = {};
        },
        newsletter(id){
            //alert(id);
            axios.post(window.location.pathname, {id:id})
            .then(response => {
                console.log(response.data)
                // /this.message =response
            })
            .catch(error => {
                console.log(error)
                this.errored = true
            })
        }
    }
});

