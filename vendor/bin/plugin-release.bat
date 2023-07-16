@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../glpi-project/tools/tools/plugin-release
SET COMPOSER_RUNTIME_BIN_DIR=%~dp0
python "%BIN_TARGET%" %*
