
const app = Vue.createApp({
            data() {
                return {
                    reports: [],
                    total: [],
                    view_adress: false,
                    search: {
                        type:1,
                        date_begin: new Date().toISOString().slice(0, 10),
                        date_end: new Date().toISOString().slice(0, 10),
                    }
                }
            },
            created() {
                this.Post()
            },
            methods: {
                toExcel: function() {
                    var workbook = XLSX.utils.table_to_book(document.getElementById('table-export'), {
                        raw: true,
                    });
                    XLSX.writeFile(workbook, document.title + '.xlsx');
                },
                Post: function() {
                    this.view_adress = this.search.type ==2 ?? true;
                    axios.post('/doit/function/get_report.php', {
                            getReport: this.search.type
                        })
                        .then((response) => {
                            console.log(response.data);
                            this.reports = response.data.reports;
                            this.total = response.data.total;
                            
                        })
                        .catch((error) => {
                            console.log(error)
                        });
                },
                numStr(n) {
                    return String(n).replace(/\B(?=(?:\d{3})+(?!\d))/g, ' ');
                },
            },
        })
        app.mount('#app')
