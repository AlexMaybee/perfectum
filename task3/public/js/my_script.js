window.onload = () => {
    let comm = new Comment();
    // $('.header').append('<div class="col-3 bg-danger">OLOLO</div>');
}


class Comment {
    constructor() {

        let commentForm = document.querySelector('.comment-form')
        if(commentForm.length > 0)
        {
            commentForm.addEventListener('submit',this.submitFunction)
        }



    }

    submitFunction = function (event) {
        event.preventDefault();

        let self = this,
            resultDiv = document.createElement('div'),
            result = [],
            formData = {},
            form = this

        result.push(Validation.checkLength(this.email,3))
        result.push(Validation.checkLength(this.comment,6))

        // console.log('EVENT WORKS!');
        console.log(result.indexOf(false));


        if(result.indexOf(false) == -1)
        {
            let obj = $(this).serializeArray()
            for (let field of obj)
            {

                formData[field.name] = field.value
            }

            console.log(formData);

            $.ajax({
                    url: "/comment/create",
                    data: formData,
                    type: "post",
                    dataType: 'json',
                    success: function(response){

                        console.log(response);

                        // let form = document.querySelector('.comment-form');

                        if(response.result > 0){

                            // resultDiv.
                            form.reset()
                            $(form).append('<div class="alert alert-success col-12">HOHOHO!</div>')
                            location.reload()
                        }
                        else
                        {
                            // resultDiv.classList.add('')

                            console.log(typeof response.errors);
                            // for(let error of response.errors)
                            // {

                                // resultDiv.innerHTML = '<div class="alert alert-danger" role="alert">\n' +
                                //     'A simple danger alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.\n' +
                                //     '</div>'
                            // }

                            // $(this).append('<div class="bg-danger col-12">HOHOHO!</div>')


                        }
                    }
                });


            // self.ajaxRequest(formData);

        }
    }

    ajaxRequest = function (formData) {

    }

}