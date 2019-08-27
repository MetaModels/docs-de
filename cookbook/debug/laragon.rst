.. _rst_cookbook_debug_laragon:

Laragon
===============

Cmder
SSH
in Datei `bin\cmder\config\user-profile.cmd` die Zeile

`call "%GIT_INSTALL_ROOT%/cmd/start-ssh-agent.cmd"` die "::" entfernen zum Ent-Kommentieren...

wenn das nicht geht, auf Konsole

ssh-agent -s
ssh-add ~/.ssh/mm_ssh (ggf. PW einsetzen)

.. |img_symfony-toolbar| image:: /_img/screenshots/cookbook/debug/symfony-toolbar.jpg