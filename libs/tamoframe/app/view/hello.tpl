{% extends "base.html" %}
{% block main %}
<div>
    HELLO!! {{hello}}<br><br><br>

    <form action="/hello/samplePost/" method="post">
        yourname <input type="text" name="hello" value="" /><br>
        <input type="submit" value="hellopost" />
    </form>
    <form action="/hello/sampleGet/" method="get">
        yourname <input type="text" name="hello" value="" /><br>
        yourname <input type="text" name="hello2" value="" /><br>
        <input type="submit" value="helloget" />
    </form>

    <a href="/hello/sampleGet/?hello=aaaaa&amp;hello2=bbbbb">GET（&\amp;）で渡す<a>
    <br><br>
    <a href="/hello/sample/テスト">引数に「テスト」を渡す<a>
</div>
{% endblock %}