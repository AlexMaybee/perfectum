class Validation{

    static checkLength = (name,minLength) =>
    {
        let val = name.value.trim(),
            parentDiv = name.parentNode,
            errorDiv = name.parentNode.querySelector('.invalid-feedback')

        if(errorDiv != null) errorDiv.remove();

        if(val != null && val.length >= minLength)
        {
            name.classList.remove('is-invalid')
            return true
        }
        else
        {
            errorDiv = document.createElement('div')
            errorDiv.classList.add('invalid-feedback')
            errorDiv.classList.add('text-center')
            errorDiv.innerText = (val.length == 0) ? 'field is required' : minLength + ' characters minimum!'
            parentDiv.append(errorDiv)

            name.classList.add('is-invalid')
            return false
        }
    }

    resetFormAfterSuccess = (formObj) =>
    {
        for (let elem of formObj)
        {
            elem.classList.remove('is-valid')
            console.log(elem)
        }
    }



}