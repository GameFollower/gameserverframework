<?php

namespace GeneralModule;

/**
* 定义全局指令集
*/

class GAME_CMD 
{
	//不同指令头以CMD开头

	const CMD_HELLO_CLIENT = 1000;
	const STC_HELLO_PING = 1;


	const CMD_GAME_LOGIN = 0x1101;
	const CTS_ACTION_LOGIN = 1;
	const STC_ACTION_LOGIN = 2;


	const CMD_GAME_INIT = 1002;
	const CTS_ACTION_INIT = 1;
	const STC_ACTION_INIT = 2;
}

class SERVER_INI
{
	const SERVER_PLAYER_ID_INDEX = 1000001;
	const SERVER_PLAYER_MAX_COUNT = 100000;
	const INIT_PLAYER_COUNT = 10;
}
