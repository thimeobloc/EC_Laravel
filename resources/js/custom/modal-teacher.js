document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#teacher-form');
    const modal = document.querySelector('#teacher-modal');
    const tableBody = document.querySelector('tbody');

    const fetchTeachers = async () => {
        const response = await fetch('/api/teachers'); // Crée cette route dans web.php
        const teachers = await response.json();

        let html = '';
        teachers.forEach(teacher => {
            html += `
                <tr>
                    <td>${teacher.last_name}</td>
                    <td>${teacher.first_name}</td>
                    <td>
                        <div class="flex items-center justify-between">
                            <a class="text-success" href="#"><i class="ki-filled ki-shield-tick"></i></a>
                            <a class="hover:text-primary cursor-pointer" href="#" data-id="${teacher.id}" onclick="editTeacher(${teacher.id})"><i class="ki-filled ki-cursor"></i></a>
                        </div>
                    </td>
                </tr>`;
        });

        tableBody.innerHTML = html;
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const id = formData.get('id');
        const url = id ? `/teachers/${id}` : '/teachers';
        const method = id ? 'PUT' : 'POST';

        const response = await fetch(url, {
            method: method,
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
            body: formData,
        });

        const result = await response.json();

        if (result.success) {
            form.reset();
            modal.close(); // À adapter selon ta lib JS modal
            fetchTeachers();
        }
    });

    window.editTeacher = async (id) => {
        const response = await fetch(`/teachers/${id}`);
        const teacher = await response.json();

        form.querySelector('[name="id"]').value = teacher.id;
        form.querySelector('[name="first_name"]').value = teacher.first_name;
        form.querySelector('[name="last_name"]').value = teacher.last_name;
        form.querySelector('[name="email"]').value = teacher.email;

        modal.showModal(); // à adapter selon ta lib
    };

    fetchTeachers();
});
