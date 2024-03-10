<script>
    document.addEventListener('DOMContentLoaded', function(){
        let counter = 0;
        const Form = {
            Init: function(config){
                this.config = config;

                this.BindEvents();
            },
            BindEvents: function(){
                let here = this.config;

                here.btn_clr.addEventListener('click', this.ClearField.bind(this, {param: 1}));
                here.btn_clr_tbl.addEventListener('click', this.ClearField.bind(this, {param: 2}));
                here.btn_sub.addEventListener('click', this.CreateForm);
                here.btn_search.addEventListener('click', this.ReadForm.bind(this, {param: 1}));
                here.tbl_tbl.addEventListener('click', this.DeleteForm);
                here.tbl_tbl.addEventListener('click', this.UpdateForm);
            },
            ClearField: (e)=> {
                const self = Form.config;
                const route = (typeof e == 'object') ? e.param : e ;

                switch(route){
                    case 1:
                        self.in_fname.value = '';
                        self.in_lname.value = '';
                        self.in_bday.value = '';
                        self.in_age.value = '';
                        self.txt_address.value = '';
                        break;
                    case 2:
                        while(self.tbl_tbody.firstChild){
                            self.tbl_tbody.removeChild(self.tbl_tbody.firstChild);
                        }
                        break;
                    default: 
                        console.log('Please Specify Which Route');
                        break;
                }
            },
            CreateForm: ()=> {
                const self = Form.config;

                let fname = self.in_fname.value.trim().toLowerCase().replace(/\s+/g, ' ');
                let lname = self.in_lname.value.trim().toLowerCase().replace(/\s+/g, ' ');
                let fullname = fname + ' ' + lname;
                let bday = new Date(self.in_bday.value);
                let bdayFormatted = bday.toLocaleDateString('en-US');
                let bdayYear = bday.getFullYear();
                let age = parseInt(self.in_age.value);
                let address = self.txt_address.value.trim().replace(/\s+/g, ' ');
                let formHTML = '';
                let uniqueId = Math.floor(Math.random() * 1000000);
                let letterRegex = /^[A-Za-z]+$/;
                let currentDate = new Date();
                let currentYear = currentDate.getFullYear();
                let trs = self.tbl_tbody.getElementsByTagName('tr');
                let formDataObj = new FormData()
                formDataObj.append('unid', uniqueId);
                formDataObj.append('fname', fname);
                formDataObj.append('lname', lname);
                formDataObj.append('fullname', fullname);
                formDataObj.append('address', address);
                formDataObj.append('birthday', bdayFormatted);
                formDataObj.append('age', age);

                for(let i = 0; i < trs.length; i++){
                    let tds = trs[i].getElementsByTagName('td');
                    
                    if(tds.length > 1){
                        let tdFname = tds[0].getAttribute('data-fname');
                        let tdLname = tds[0].getAttribute('data-lname');
                        let tdFullname = tdFname + ' ' + tdLname;

                        if(tdFullname == fullname && self.btn_sub.getAttribute('data-action') != 'update'){
                            alert('Entry Already Exist');
                            return;
                        }
                    }
                }

                if(fname == '' || lname == '' || address == '' || bday == '' || age == ''){
                    alert('All Fields Are Required');
                }
                else if(!letterRegex.test(fname) || !letterRegex.test(lname)) {
                    alert("Invalid input. Only letters are allowed.");
                }
                else if(bdayYear >= currentYear){
                    alert("Input date is greater than or equal current date.");
                }
                else if(age === 0 || age < 0){
                    alert("Age must be 1 year old or above");
                }
                else{
                    counter += 1;
                    formHTML += `
                        <tr id="${uniqueId}">
                            <th scope="row" data-label="No">${counter}</th>
                            <td data-label="Fullname" data-fname="${fname}" data-lname="${lname}">${fullname}</td>
                            <td data-label="Address">${address}</td>
                            <td data-label="Birthday">${bdayFormatted}</td>
                            <td data-label="Age">${age}</td>
                            <td data-label="td-buttons">
                                <button class="btn btn-primary btn-edit"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-primary btn-del"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    `;
                    if(self.btn_sub.getAttribute('data-action') == 'create'){
                        formDataObj.append('type', 1);
                        self.tbl_tbody.insertAdjacentHTML('beforeend', formHTML);
                        Form.CallAjax('../../controller/form_ctrl.php', formDataObj, 1);
                    }
                    else{
                        let trId = self.btn_sub.getAttribute('tr-id');
                        let trElements = document.getElementsByTagName('tr');

                        for(let i = 0; i < trElements.length; i++){
                            if(trElements[i].id === trId){
                                let tdElements = trElements[i].getElementsByTagName('td');

                                if(tdElements.length > 1){
                                    tdElements[0].setAttribute('data-fname', fname);
                                    tdElements[0].setAttribute('data-lname', lname);
                                    tdElements[0].textContent = fullname;
                                    tdElements[1].textContent = address;
                                    tdElements[2].textContent = bdayFormatted;
                                    tdElements[3].textContent = age;
                                }
                                break;
                            }
                        }
                        self.btn_sub.setAttribute('data-action', 'create');
                        formDataObj.append('type', 3);
                        formDataObj.append('unid', self.btn_sub.getAttribute('tr-id'));
                        Form.CallAjax('../../controller/form_ctrl.php', formDataObj, 3);
                    }
                }
            },
            ReadForm: (e, data)=> {
                const self = Form.config;
                const route = (typeof e == 'object') ? e.param : e ;
                const src_lname = self.in_search.value.trim().toLowerCase().replace(/\s+/g, ' ');
                // const letterRegex = /^[A-Za-z]+$/;
                const formDataObj = new FormData();
                let tableHTML = '';
                formDataObj.append('lname', src_lname);

                

                switch(route){
                    case 1:
                        // if(!letterRegex.test(src_lname)){
                        //     alert("Invalid input. Only letters are allowed.");
                        // }
                        // else{
                            formDataObj.append('type', 2);
                            Form.CallAjax('../../controller/form_ctrl.php', formDataObj, 2);
                        // }
                        break;
                    case 2:
                        let results = data.results;
                        
                        if(results !== undefined || self.in_search.value == ''){
                            for(let i = 0; i < results.length; i++){
                                tableHTML += `
                                    <tr id="${results[i][1]}">
                                        <th scope="row" data-label="No">${results[i][0]}</th>
                                        <td data-label="Fullname" data-fname="${results[i][2]}" data-lname="${results[i][3]}">${results[i][4]}</td>
                                        <td data-label="Address">${results[i][5]}</td>
                                        <td data-label="Birthday">${results[i][6]}</td>
                                        <td data-label="Age">${results[i][7]}</td>
                                        <td data-label="td-buttons">
                                            <button class="btn btn-primary btn-edit"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-primary btn-del"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                `;
                            }
                        }
                        else{
                            tableHTML += `
                                <tr>
                                    <th colspan="6" style="color: red;">No Records Found</th>
                                </tr>
                            `;
                        }
                        Form.ClearField({param: 2});
                        self.tbl_tbody.insertAdjacentHTML('beforeend', tableHTML);
                        break;
                    default:
                        console.log('Please Specify Which Route');
                        break;
                }
            },
            UpdateForm: (e)=> {
                const self = Form.config;
                const btn = e.target.closest('.btn-edit');

                if(!btn){ return; }

                let tr = btn.closest('tr');
                let tds = tr.querySelectorAll('td');
                let trId = tr.getAttribute('id');
                let fname = tds[0].getAttribute('data-fname');
                let lname = tds[0].getAttribute('data-lname');
                let address = tds[1].textContent;
                let birthday = tds[2].textContent;
                if(birthday.includes('-')){
                    let parts = birthday.split('-');
                    let bdayFormatted = `${parts[0]}-${parts[2]}-${parts[1]}`;
                    self.in_bday.value = bdayFormatted;
                }
                else{
                    let parts = birthday.split('/');
                    let bdayFormatted = `${parts[2]}-${parts[0].padStart(2, '0')}-${parts[1].padStart(2, '0')}`;
                    self.in_bday.value = bdayFormatted;
                }
                let age = tds[3].textContent;

                self.btn_sub.setAttribute('data-action', 'update');
                self.btn_sub.setAttribute('tr-id', trId);
                self.in_fname.value = fname;
                self.in_lname.value = lname;
                self.txt_address.value = address;
                self.in_age.value = age;
            },
            DeleteForm: (e)=> {
                const self = Form.config;
                const btn = e.target.closest('.btn-del');
                const tr = btn.closest('tr');
                const trId = tr.getAttribute('id');
                const delObj = new FormData();
                delObj.append('trId', trId);
                delObj.append('type', 4);

                if(!btn){ return; }

                tr.remove();
                Form.CallAjax('../../controller/form_ctrl.php', delObj, 4);
            },
            CallAjax: (url, data, type)=> {
                const self = Form.config;
                let xhr = new XMLHttpRequest();

                xhr.open('POST', url, true);

                xhr.onload = function(){
                    if(this.status === 200){
                        let evt = this.responseText;
                        let data = JSON.parse(evt);

                        switch(type){
                            case 1:
                                console.log('case 1 is accessed: ', data);
                                break;
                            case 2:
                                Form.ReadForm(2, data);
                                break;
                            case 3:
                                console.log('case 3 is accessed: ', data);
                                break;
                            case 4:
                                console.log('case 4 is accessed: ', data);
                                break;
                            default:
                                console.log('Please Specify Which Route');
                                break;
                        }
                    }
                    else{
                        console.log(`status: ${this.status}`);
                    }
                }

                xhr.onerror = function(){
                    console.log('Error');
                }

                xhr.send(data);
            }
        };
        Form.Init({
            btn_clr                 :                   document.querySelector('#btn-clr'),
            btn_sub                 :                   document.querySelector('#btn-sub'),
            btn_search              :                   document.querySelector('#btn-search'),
            btn_clr_tbl             :                   document.querySelector('#btn-clr-tbl'),

            form_creds              :                   document.querySelector('#form-creds'),

            in_fname                :                   document.querySelector('#in-fname'),
            in_lname                :                   document.querySelector('#in-lname'),
            in_bday                 :                   document.querySelector('#in-bday'),
            in_age                  :                   document.querySelector('#in-age'),
            in_search               :                   document.querySelector('#in-search'),

            txt_address             :                   document.querySelector('#txt-address'),
            tbl_tbl                 :                   document.querySelector('#tbl-tbl'),
            tbl_tbody               :                   document.querySelector('#tbl-tbody'),
        });
    });
</script>