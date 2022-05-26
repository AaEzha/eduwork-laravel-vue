 var controller = new Vue({
        el: '#controller',
        data: {
            datas: [],
            data: {},
            actionUrl,
            apiUrl,
            status:false,
        },
        mounted: function () {
            this.datatable();
        },
        methods: {
            datatable() {
                const _this = this;
                _this.table = $('#datatable').DataTable({ ajax: {
                    url: _this.apiUrl,
                    type: 'GET',
                },
                columns: columns
            }).on('xhr', function () {
                _this.datas = _this.table.ajax.json().data;
            });
            },
             addData() {
                // this.actionUrl = '{{ url('authors') }}';
                this.data= {};
                this.status=false;
                $('#exampleModal').modal();
            },
            editData(event, row) {
                this.data = this.datas[row];
                // this.actionUrl = '{{ url('authors') }}'+'/'+this.data.id;
                this.status=true;
                $('#exampleModal').modal();
            },
            deleteData(event, id) {
                // console.log(id);
                // this.actionUrl =  '{{ url('authors') }}'+'/'+id ;

                if(confirm("Are you sure ?"))
                {
                    // Romove table row
                    $(event.target).parents('tr').remove();
                    axios.post(this.actionUrl+'/'+id, {_method: 'DELETE'}).then(response => {
                        // location.reload();
                        alert('Data has been removed');
                     });
                }
            },
            submitForm(event, id)
            {
                event.preventDefault();
                const _this = this;
                var actionUrl =! this.status ? this.actionUrl : this.actionUrl+'/'+id;
                axios.post(actionUrl, new FormData($(event.target)[0])).then(response => { $('#exampleModal').modal('hide');
                _this.table.ajax.reload();
            });
            },


        }
    });
