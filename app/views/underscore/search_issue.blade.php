<div class="alert-success"><center> Details sur le document</center></div>
<dl class="dl-horizontal">
    <dt>Book Name</dt>
    <dd><%= obj.book_name %></dd>
    <dt>Author</dt>
    <dd><%= obj.author %></dd>
    <dt>Book Category</dt>
    <dd><%= obj.category %></dd>
    <dt>Available Status</dt>
    <dd><%= obj.available_status %></dd>
    <dt>Date of addition</dt>
    <dd><%= obj.added_at_timestamp %></dd>
</dl>

<%
    if(obj.hasOwnProperty('student')){
%>
<div class="alert-success"><center>Détails de l'élève</center></div>
<dl class="dl-horizontal">
    <dt> ID de l'etudient </dt>
    <dd><%= obj.student.student_id %></dd>
    <dt>Nom d'étudiant</dt>
    <dd><%= obj.student.first_name %> <%= obj.student.last_name %></dd>
    <dt>Catégorie d'étudiant</dt>
    <dd><%= obj.student.category %></dd>
    <dt>Numéro de rôle</dt>
    <dd><%= obj.student.roll_num %></dd>
</dl>
<%
    }
%>