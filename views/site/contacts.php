<?php

	$this->title = 'Мужской спа-салон «Барон»';

?>
	<div id="content" class="clearfix">
		<h1 class="contacts_title">Контакты</h1>
		<p class="contacts_text"><?=$text?></p>
		<section id="contacts_page">
				<div id="map">
				
				</div>
		</section>
		<aside>
			<div id="feedback">
				<h2>Форма для вопросов и предложений</h2>
				<form>
					<input type="text" name="name" placeholder="Как вас зовут?">
					<input type="text" name="email" placeholder="E-mail">
					<select name="theme">
						<option>Выберите тему</option>
						<option>Вопрос</option>
						<option>Предложение</option>
					</select>
					<textarea>Текст сообещния</textarea>
					<input type="button" value="Отправить">
				</form>
			</div>
		</aside>
	</div>