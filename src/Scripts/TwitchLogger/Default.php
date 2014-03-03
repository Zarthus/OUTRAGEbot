<?php
/**
 *	OUTRAGEbot - PHP 5.3 based IRC bot
 *
 *	Author:		David Weston <westie@typefish.co.uk>
 *
 *	Version:        2.0.0-Alpha
 *	Git commit:     0638fa8bb13e1aca64885a4be9e6b7d78aab0af7
 *	Committed at:   Wed Aug 24 23:16:55 BST 2011
 *
 *	Licence:	http://www.typefish.co.uk/licences/
 *
 *	This is obviously, the blank script.
 */


class TwitchLogger extends Script
{
	public $commandsExecuted = 0;

	/**
	 *	Called when the Script is loaded.
	 */
	public function onConstruct()
	{
		echo "Loaded Twitch Logger \n";
	}


	/**
	 *	Called when the Script is removed.
	 */
	public function onDestruct()
	{
		echo "Unloaded Twitch Logger \n";
	}


	/**
	 *	Called when the bot successfully connects to the network.
	 */
	public function onConnect()
	{
		$this->Raw("JOIN :#twitchplayspokemon");
	}

	/**
	 *	Called when someone sends a message in a channel.
	 */
	public function onChannelMessage($sChannel, $sNickname, $sMessage)
	{
		$ts = $this->getTimestamp() . ' ';
		if ( $this->isTwitchCommand($sMessage) )
		{
			$sMessage = strtolower($sMessage);
			$eMsg = addslashes(htmlentities($sMessage, ENT_QUOTES));
			$this->commandsExecuted++;
			
			file_put_contents("/home/zarthus/twitchbot/logs/cmds.log", $ts . $sNickname . '/' . $this->commandsExecuted . ': ' . $eMsg . "\r\n", FILE_APPEND);
			file_put_contents("/home/zarthus/twitchbot/logs/" . $eMsg . ".log", $ts . $sNickname . ': ' . $eMsg . " ({$this->commandsExecuted})\r\n", FILE_APPEND);
			
		}
		else
		{
			$eMsg = addslashes(htmlentities($sMessage, ENT_QUOTES));
			
			file_put_contents("/home/zarthus/twitchbot/logs/chat.log", $ts . $sNickname . ': ' . $eMsg . "\r\n", FILE_APPEND);
		}
	}
	
	public function getTimestamp()
	{
		return '[' .  date("Y-m-d H:i:s") . ']';
	}
	
	public function isTwitchCommand($msg)
	{
		//$regex = '/^(a|b|up|left|down|right|start)[0-9]?((a|b|up|left|down|right|start)[0-9]?)?((a|b|up|left|down|right|start)[0-9]?)?((a|b|up|left|down|right|start)[0-9]?)?$/i';
		/*
		$regex = "^((((?<a>a)|(?<b>b)|(?<up>up)|(?<left>left)|(?<down>down)|(?<right>right)|(?<start>start))[2-9]?)" .
				 "(((?(a)^$|(?<a2>a))|(?(b)^$|(?<b2>b))|(?(up)^$|(?<up2>up))|(?(left)^$|(?<left2>left))|(?(right)^$|(?<right2>right))|(?(down)^$|(?<down2>down))|(?(start)^$|(?<start2>start)))[2-9]?)?" .
				 "(((?(a)^$|(?(a2)^$|(?<a3>a)))|(?(b)^$|(?(b2)^$|(?<b3>b)))|(?(up)^$|(?(up2)^$|(?<up3>up)))|(?(left)^$|(?(left2)^$|(?<left3>left)))|(?(right)^$|(?(right2)^$|(?<right3>right)))|(?(down)^$|(?(down2)^$|(?<down3>down)))|(?(start)^$|(?(start2)^$|(?<start3>start))))[2-9]?)?" .
				 "(((?(a)^$|(?(a2)^$|(?(a3)^$|a)))|(?(b)^$|(?(b2)^$|(?(b3)^$|b)))|(?(up)^$|(?(up2)^$|(?(up3)^$|up)))|(?(left)^$|(?(left2)^$|(?(left3)^$|left)))|(?(right)^$|(?(right2)^$|(?(right3)^$|right)))|(?(down)^$|(?(down2)^$|(?(down3)^$|down)))|(?(start)^$|(?(start2)^$|(?(start3)^$|start))))[2-9]?)?|anarchy|democracy)$/ix";
		*/

		$regex = "/^((((?<a>a)|(?<b>b)|(?<up>up)|(?<left>left)|(?<down>down)|(?<right>right)|(?<start>start))[2-9]?)" .
				 "(((?(a)^$|(?<a2>a))|(?(b)^$|(?<b2>b))|(?(up)^$|(?<up2>up))|(?(left)^$|(?<left2>left))|(?(right)^$|(?<right2>right))|(?(down)^$|(?<down2>down))|(?(start)^$|(?<start2>start)))[2-9]?)?" .
				 "(((?(a)^$|(?(a2)^$|(?<a3>a)))|(?(b)^$|(?(b2)^$|(?<b3>b)))|(?(up)^$|(?(up2)^$|(?<up3>up)))|(?(left)^$|(?(left2)^$|(?<left3>left)))|(?(right)^$|(?(right2)^$|(?<right3>right)))|(?(down)^$|(?(down2)^$|(?<down3>down)))|(?(start)^$|(?(start2)^$|(?<start3>start))))[2-9]?)?" .
				 "(((?(a)^$|(?(a2)^$|(?(a3)^$|a)))|(?(b)^$|(?(b2)^$|(?(b3)^$|b)))|(?(up)^$|(?(up2)^$|(?(up3)^$|up)))|(?(left)^$|(?(left2)^$|(?(left3)^$|left)))|(?(right)^$|(?(right2)^$|(?(right3)^$|right)))|(?(down)^$|(?(down2)^$|(?(down3)^$|down)))|(?(start)^$|(?(start2)^$|(?(start3)^$|start))))[2-9]?)?|anarchy|democracy)$/ix";		

		return preg_match($regex, $msg) === 1;
	}
}
