<style>
    /* GENERAL */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "Poppins", sans-serif;
        background: grey;
    }

    input, textarea{
        outline: none;
        padding: 0.60rem;
    }

    /* APP CONTAINER */
    #div-container{
        display: flex;
        padding-top: 1rem;
        padding-left: 1rem;
    }

    /* FORM */
    .card{
        width: 20rem;
    }
    .card-header{
        text-align: center;
    }
    .card-body{
        display: flex;
        flex-direction: column;
    }
    #form-creds{
        display: flex;
        flex-direction: column;
        row-gap: 2rem;
    }
    #div-btns{
        display: flex;
        justify-content: center;
        column-gap: 2rem;
        margin-top: 2rem;
    }

    /* TABLE */
    #table-container{
        border: none;
        width: 60rem;
        max-height: 33.7rem;
        overflow-y: auto;
        position: absolute;
        left: 23rem;
        border-radius: 5px;
        background: white;
    }
    .table{
        border: none;
        text-align: center;
        width: 100%;
        background: white;
    }

    /* SEARCH */
    #div-search{
        display: flex;
        padding: 0.50rem;
        column-gap: 0.50rem;
    }

    .btn-search-style{
        border-radius: 50%;
    }
</style>