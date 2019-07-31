<script type="text/javascript">

    var modalId = $('#editEmployee');

    modalId.on('show.bs.modal', function (e) {

        var button = $(e.relatedTarget) 
        var recipient = button.data('title')
        var job_title = button.data('job_title')
        var responsability = button.data('responsability')
        var salary = button.data('salary')
        var budget = button.data('budget')
        var currency = button.data('currency')
        var employee = button.data('employee')
        var form = $(e.relatedTarget).closest('form');
        var self = $(this)

        self.find('.modal-title').text(recipient);
        self.find('.modal-body #employee').val(employee);
        self.find('.modal-body #job_title').val(job_title);
        self.find('.modal-body #responsability').val(responsability);
        self.find('.modal-body #salary-output').text(salary);
        self.find('.modal-body #salary-range').attr({'max' : budget}).val(salary);
        self.find('.modal-body #salary-currency').text(currency);
    });
    


</script>