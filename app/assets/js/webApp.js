const webApp = {
	menu: {
		toggleMenu(){
			let element = document.getElementById('webApp-main__menu');
			element.classList.toggle('active');
		}
	},
	form: {
		loading: {
			show(form){
				if($(form + ' .webAppForm__loading').length){
					$(form + ' .webAppForm__loading').fadeIn(300);
				} else {
					let _div = document.createElement('div');
					let _image = document.createElement('img');
					
					_image.src = '/assets/img/loading.gif';
					
					_div.setAttribute('class', 'webAppForm__loading');
					_div.appendChild(_image);
					
					$(form).prepend(_div);
				
					$(form + ' .webAppForm__loading').fadeIn(300);
				}
			},
			hide(form){
				$(form + ' .webAppForm__loading').fadeOut(300);
			}
		},
		error: {
			setMessage(form, content, html = false){
				if(html){
					$(form + ' .webAppForm__error').html(content);
				} else {
					$(form + ' .webAppForm__error').text(content);
				}
			},
			show(form, delay = 300){
				$(form + ' .webAppForm__error').fadeIn(delay);
			},
			hide(form, delay = 300){
				$(form + ' .webAppForm__error').fadeOut(delay);
			}
		}
	},
	schools: {
		newSchool(){
			let _form = '#webAppForm-school';
			
			webApp.form.loading.show(_form);
			
			webApp.form.error.hide(_form, 0);
			
			$.ajax({
				url: '/api/schools/newSchool',
				type: 'POST',
				data: $(_form).serialize()
			}).done(function(data){
				window.location.href = data.redirect;
			}).fail(function(data){
				webApp.form.error.setMessage(_form, data.responseJSON.message);
				webApp.form.error.show(_form);
				
				webApp.form.loading.hide(_form);
			});
		},
		editSchool(){
			let _form = '#webAppForm-school';
			
			webApp.form.loading.show(_form);
			
			webApp.form.error.hide(_form, 0);
			
			$.ajax({
				url: '/api/schools/editSchool',
				type: 'POST',
				data: $(_form).serialize()
			}).done(function(data){
				window.location.href = data.redirect;
			}).fail(function(data){
				webApp.form.error.setMessage(_form, data.responseJSON.message);
				webApp.form.error.show(_form);
				
				webApp.form.loading.hide(_form);
			});
		},
		removeSchool(id){
			let _form = '#schools';
			
			webApp.form.loading.show(_form);
			
			$.ajax({
				url: '/api/schools/deleteSchool',
				type: 'POST',
				data: { 'school_id': id }
			}).done(function(data){
				window.location.href = '/';
			}).fail(function(data){
				Swal.fire('Oops...', data.responseJSON.message, 'error').then((result) => {
					webApp.form.loading.hide(_form);
				});
			});
		},
		prepareRemoveSchool(id){
			Swal.fire({
				title: 'Você tem certeza?',
				text: 'Você não poderá reverter isso!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, exclua!',
				cancelButtonText: 'Não, cancelar!'
			}).then((result) => {
				if(result.isConfirmed){
					webApp.schools.removeSchool(id);
				}
			});
		}
	},
	classes: {
		addStudent(id){
			$.ajax({
				url: '/api/classes/addStudent',
				type: 'POST',
				data: {
					'class_id': school.class.id,
					'student_id': id
				}
			}).done(function(data){
				location.reload();
			}).fail(function(data){
				Swal.fire('Oops...', data.responseJSON.message, 'error').then((result) => {
					webApp.form.loading.hide(_form);
				});
			});
		},
		newClasse(){
			let _form = '#webAppForm-classe';
			
			webApp.form.loading.show(_form);
			
			webApp.form.error.hide(_form, 0);
			
			$.ajax({
				url: '/api/classes/newClasse',
				type: 'POST',
				data: $(_form).serialize()
			}).done(function(data){
				window.location.href = data.redirect;
			}).fail(function(data){
				webApp.form.error.setMessage(_form, data.responseJSON.message);
				webApp.form.error.show(_form);
				
				webApp.form.loading.hide(_form);
			});
		},
		editClasse(){
			let _form = '#webAppForm-classe';
			
			webApp.form.loading.show(_form);
			
			webApp.form.error.hide(_form, 0);
			
			$.ajax({
				url: '/api/classes/editClasse',
				type: 'POST',
				data: $(_form).serialize()
			}).done(function(data){
				window.location.href = data.redirect;
			}).fail(function(data){
				webApp.form.error.setMessage(_form, data.responseJSON.message);
				webApp.form.error.show(_form);
				
				webApp.form.loading.hide(_form);
			});
		},
		removeClasse(id){
			let _form = '#classes';
			
			webApp.form.loading.show(_form);
			
			$.ajax({
				url: '/api/classes/deleteClasse',
				type: 'POST',
				data: { 'classe_id': id }
			}).done(function(data){
				location.reload();
			}).fail(function(data){
				Swal.fire('Oops...', data.responseJSON.message, 'error').then((result) => {
					webApp.form.loading.hide(_form);
				});
			});
		},
		removeStudent(id){
			let _form = '#students';
			
			webApp.form.loading.show(_form);
			
			$.ajax({
				url: '/api/classes/deleteStudent',
				type: 'POST',
				data: {
					'class_id': school.class.id,
					'student_id': id
				}
			}).done(function(data){
				location.reload();
			}).fail(function(data){
				Swal.fire('Oops...', data.responseJSON.message, 'error').then((result) => {
					webApp.form.loading.hide(_form);
				});
			});
		},
		prepareAddStudent(){
			Swal.fire({
				title: 'Adicionando Novo Aluno',
				input: 'select',
				text: 'Informe o Nome ou ID do Aluno',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Adicionar',
				cancelButtonText: 'Cancelar',
				onOpen: function(){
					$('.swal2-select').select2({
						placeholder: 'Selecione Aluno',
						ajax: {
							url: '/api/students/all',
							type: 'POST',
							data: function(params){
								var query = {
									search: params.term,
									school_id: school.id
								};
								
								return query;
							},
							processResults: function(data){
								let students = [];
								
								data.students.forEach(function(item, index){
									students.push({ id: item.id, text: item.name })
								});
								
								return {
									results: students
								};
							}
						}
					});
				}
			}).then((result) => {
				if(result.isConfirmed){
					webApp.classes.addStudent(result.value);
				}
			});
		},
		prepareRemoveClasse(id){
			Swal.fire({
				title: 'Você tem certeza?',
				text: 'Você não poderá reverter isso!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, exclua!',
				cancelButtonText: 'Não, cancelar!'
			}).then((result) => {
				if(result.isConfirmed){
					webApp.classes.removeClasse(id);
				}
			});
		},
		prepareRemoveStudent(id){
			Swal.fire({
				title: 'Você tem certeza?',
				text: 'Você não poderá reverter isso!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, exclua!',
				cancelButtonText: 'Não, cancelar!'
			}).then((result) => {
				if(result.isConfirmed){
					webApp.classes.removeStudent(id);
				}
			});
		}
	},
	students: {
		newStudent(){
			let _form = '#webAppForm-student';
			
			webApp.form.loading.show(_form);
			
			webApp.form.error.hide(_form, 0);
			
			$.ajax({
				url: '/api/students/newStudent',
				type: 'POST',
				data: $(_form).serialize()
			}).done(function(data){
				window.location.href = data.redirect;
			}).fail(function(data){
				webApp.form.error.setMessage(_form, data.responseJSON.message);
				webApp.form.error.show(_form);
				
				webApp.form.loading.hide(_form);
			});
		},
		editStudent(){
			let _form = '#webAppForm-student';
			
			webApp.form.loading.show(_form);
			
			webApp.form.error.hide(_form, 0);
			
			$.ajax({
				url: '/api/students/editStudent',
				type: 'POST',
				data: $(_form).serialize()
			}).done(function(data){
				window.location.href = data.redirect;
			}).fail(function(data){
				webApp.form.error.setMessage(_form, data.responseJSON.message);
				webApp.form.error.show(_form);
				
				webApp.form.loading.hide(_form);
			});
		},
		removeStudent(id){
			let _form = '#students';
			
			webApp.form.loading.show(_form);
			
			$.ajax({
				url: '/api/students/deleteStudent',
				type: 'POST',
				data: { 'student_id': id }
			}).done(function(data){
				location.reload();
			}).fail(function(data){
				Swal.fire('Oops...', data.responseJSON.message, 'error').then((result) => {
					webApp.form.loading.hide(_form);
				});
			});
		},
		prepareRemoveStudent(id){
			Swal.fire({
				title: 'Você tem certeza?',
				text: 'Você não poderá reverter isso!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, exclua!',
				cancelButtonText: 'Não, cancelar!'
			}).then((result) => {
				if(result.isConfirmed){
					webApp.students.removeStudent(id);
				}
			});
		}
	}
};