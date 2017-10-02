<div class="alert-success"><center> Details de l'etudient</center></div>
<dl class="dl-horizontal">
<%
    var flag = false;
    if(obj.hasOwnProperty('approved')){
        flag = true;
%>
    <dt></dt>
    <dd><strong><p class="text-error">Non approuvé</p></strong></dd>
<%
    }
%>
<%
    if(obj.hasOwnProperty('rejected')){
        flag = true;
%>
    <dt></dt>
    <dd><strong><p class="text-error">Rejeté</p></strong></dd>
<%
    }
%>
    <dt> ID de l'tudient</dt>
    <dd><%= obj.student_id %></dd>
    <dt>Name of Student</dt>
    <dd><%= obj.first_name %> <%= obj.last_name %></dd>
    <dt>Student Category</dt>
    <dd><%= obj.category %></dd>
    <dt>Email ID</dt>
    <dd><%= obj.email_id %></dd>
    <dt>Roll Number</dt>
    <dd><%= obj.roll_num %>/<%= obj.branch %>/<%= obj.year %></dd>

    <%
        if(!flag){
    %>
        <dt>Nombre de livres émis</dt>
        <dd><%= obj.books_issued %></dd>
    <%
        }
    %>
</dl>

<%
    if(!flag){
        if(obj.issued_books.length > 0){
%>

<div class="alert-success"><center>Detail sur les document emprunté</center></div>

<%
            for(var book in obj.issued_books){
%>
<dl class="dl-horizontal">
    <dt>Issue ID</dt>
    <dd><%= obj.issued_books[book].book_issue_id %></dd>
    <dt>Name of Book</dt>
    <dd><%= obj.issued_books[book].name %></dd>
    <dt>Issued On</dt>
    <dd><%= obj.issued_books[book].issued_at %></dd>
</dl>
<%
            }
        }
    }
%>