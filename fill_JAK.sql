use JAK;
insert into environment (name,rewardLow,rewardHigh,path) values ('JULJSMS[BJWEIAEJEOIURDI[MUXWOIWI',0.311249,0.782974,'XPSTIEX[XPNDWQTOEZKLWKWQSWMZTXVPPTZQMOYQAWDDRQNMXYIBIAOLPDYGZFSHFPJQFJHQRWWUUWFYBSXVYCIGZLIYAEF[ZLFYJVNNVXHBQTVYTRTGHJBNPSCLLTJOSZMKG[DMZZGAQJPMQVCSKH[RPLPIZHCO[NVBDWVILXXRBGKFNCYBRCBTLMW[JMSHWV[USQLGGYQFPL[C[KXWSRCVEDQKNI[QSCJIXTUEIRFPZMUTKXSF[BBDETAQIBXR');
SET @EnvironmentID = LAST_INSERT_ID();
insert into environmenthasspace values (@EnvironmentID,'JMIO[XFABDWBWFGZVHTPOOJWYRJAKUUWYUIVGVZWPV[QLTIDTRRMT[UWFSDYELRL',1);
insert into equipment (name, category, location) values ('KAHDTSPORJSRIFRUEYHMYVEOLYAUYRIJ',0,'EOOHLN[[MZCLVJMGJGDHMTMSAUUYIKWF');
SET @EquipmentID = LAST_INSERT_ID();
insert into model (name, category, path) values ('VTGNKTJPFYAMCWUQIZVEHCNIKYKDGODG',0,'LBETYHMRKRDDDQITDXA[XEII[CGGKLUKJIZQPDHHEAXFPWBNNHQFDFAWQMRERJBSRAMRFFZASOOKKNAWIJDWAASDZDJYIUJ[CJBSPEMVJLSNXZOFMOUQWH[ABQOKON[GFIEQAXSPYIZISRAXGJZVNQ[[LJPWPCQZQT[FJQEGF[ZNBLRHVBAHPYXOPDAAHPDJHXVDHMAUSRXYDHLZPSLZCCWHIXJWQMVY[SCNZQWALOZRAZQGUXALISTICEIEZ[B[');
SET @ModelID = LAST_INSERT_ID();
insert into agent (actionspace, observationspace, path) values ('UCSJOXHFC[BYEMLYTKGVCDNDGBLRTXFJ','IHFBVZIQFIFWYWUKVEVUNXLZXONYGRAC','AQSMKKHVQYLMJDZJAQHU[MZHMDTSIUJPSFBRGVBYIDMREQVTILQHMIENLFMJBRWFJHXPGHUYTXEBQUKFFCOHQMLWOPSZLIBPLMYYFAHOZYEBMWIRASTFQ[IONMOWFELZETFFYWVUEBVHQDWLQ[ZYLRZPOSEDUCUBPZAKRXBOUWNCCSFOXLJRZTAICRF[ZBRIRSF[NTJJWNPVLXFVKJKMJEZPNWGVQXHPTSU[FCPCHYWROYOPVGIGMAPDKYDULK[C');
SET @AgentID = LAST_INSERT_ID();
insert into agentUsesModel (agentID, modelID) values (@AgentID,@ModelID);
insert into person (username, passwordHash, joined) values ('YPKJPCVB','$2b$12$q6o.w5J0l5XyPVdZavJmN.En3mfWcXOkjUNynQNjNLnkgj7GSz4Qq','Mon, 06 May 2019 00:30:28 +0000');
SET @PersonID = LAST_INSERT_ID();
insert into faculty (ID, department) values (@PersonID,'EE');
insert into EquipmentBelongsTo (equipmentID, userID) values (@EquipmentID,@PersonID);
insert into project (startDate, endDate, leadID, name) values ('Mon, 06 May 2019 00:30:28 +0000','Mon, 06 May 2019 00:30:28 +0000',@PersonID,'EYDKPQXM');
SET @ProjectID = LAST_INSERT_ID();
insert into worksOn (UserID, ProjectID) values (@PersonID,@ProjectID);
insert into person (username, passwordHash, joined) values ('NRSJMCDU','$2b$12$xzVElB0pfDHKDGDfoFyuEOetM84FvG4.gazWJwhXYxkOdzlV8QlqO','Mon, 06 May 2019 00:30:28 +0000');
SET @PersonID = LAST_INSERT_ID();
insert into student (ID, major, classification) values (@PersonID,'CSCI',2);
insert into worksOn (UserID, ProjectID) values (@PersonID,@ProjectID);
insert into experiment (ProjectID, startDate, category) values (@ProjectID,'Mon, 06 May 2019 00:30:28 +0000',0);
SET @ExperimentNo = LAST_INSERT_ID();
insert into experimentusesenvironment values (@ProjectID,@ExperimentID,@EnvironmentID);
insert into agentparticipates (projectID,experimentNo,agentID) values (@ProjectID,@ExperimentNo,@AgentID);
insert into result (ProjectID,experimentNo,completed,path) values (@ProjectID,@ExperimentNo,FALSE,'SFQZHOZAAPJOQFGNCNZGOJO[ARTRFMWLHBZWKYLHJTWHI[LECPHNMAIQQLQDPKXRWCPNIZBXOUUXEFQUCKEFANXMOJJAEXOPAREINRSEZEABO[[SLLRJHMCDYFUSOJVXPA[J[RXBRQIMNCYTYCYSST[[MCZKZUDPSZWPAFBOGMUOQPUHYZCKSSCMRWNWHPTLEDQZ[XGOHIZEFYHUCV[CKMNQPMHCXSNQIKAHVJYIMECLTMBQLJRCGAMQSADWJLLE');
insert into environment (name,rewardLow,rewardHigh,path) values ('XZOHOXMYSGIXNPHMZKPA[ZA[OUDYBINZ',0.225484,0.344886,'PIVUOUIWLFXJNAGGNNIMOSALQOGULGJVIQIXHCHHRLNRKUXTARPMZTC[VUOXDRFEMZWBHBU[AGWVRNMJNWIWKRKLGIJIIIYT[NZUMMTKCULEVVIDWZNIMZLYT[BLDVIFUFLRFTNWKXM[[D[DTGJKVHCEGWKZPFYAXHMJK[ULLWTSYVNPG[LCUGLGYZXUHXDIXSFXRFVTWWXWLRBUQXRKDSLYSVBALJDA[BHJJOXKLKGSSTZBICW[IDEKTHPUNRRJ');
SET @EnvironmentID = LAST_INSERT_ID();
insert into environmenthasspace values (@EnvironmentID,'UVZRQNPLQHV[JXZHVWLNHBOLAS[ZATLAGQSNWSDUTTBQGGGCFANJI[EXWCWOJNAT',1);
insert into equipment (name, category, location) values ('PLBVWVWZWCGEZSRJMKVLAUZWXRL[IZUR',0,'RUY[XZQLIHGHTMVT[SJGMMHYKYNMCOBO');
SET @EquipmentID = LAST_INSERT_ID();
insert into model (name, category, path) values ('WFIHXTESQNNOABLMNAWBMUUCZLQQMCCK',0,'JWTXAB[JLJIXGYDFMKGHALMEWVUNXHZGZDGUYLKXRHZRTORESFBJT[XJLGHKP[DFLRNNXIUC[WVOIFNRPSWMO[AVULBMQDJBPQTTSHGNYNK[LPTLRCRKEREOYQDCI[GVC[VGXIBRES[SMYFKFLUJEWCXMHP[UEYJGJPSJPCFGAAEZQTALTQIMRV[HEEOTC[HTXXRHTU[[ZZFNAVANFVRWNZAFIZFOMBEWHOLVOOVLINIFFVJ[PXEYXXWFEUYLFIN');
SET @ModelID = LAST_INSERT_ID();
insert into agent (actionspace, observationspace, path) values ('MEBDIISOKIUMGHKTIRVLCSON[QWRWAJT','JP[[LHE[LFKDVAH[YNTJIWJQVHD[PZSD','WIHCQCKCSZMIMLMCQPA[J[KGCYURSE[OGDZIMXKIHNCKIJGHCWATSOCPAAMYTTNFLRTEI[LSJIMLTHXOOFWLBTAES[DOBVHK[YDLQTFZHS[YKSGZZPMRDTFPQNHVSWZPABPSUAFBKZYGOGFDEKBPUNJN[T[UGZIOZ[TNCVXUZOKONOPKNDWNS[XDWCXJSKDERRSZBXUATKHLLXGBCFOHPDUKNLMCDMGMZGQUJTCACNMKKHVSKAQBGIZXZFHUPXBJ');
SET @AgentID = LAST_INSERT_ID();
insert into agentUsesModel (agentID, modelID) values (@AgentID,@ModelID);
insert into person (username, passwordHash, joined) values ('UGYOENFO','$2b$12$ARVftwvQJ3tUVSkMuGn0fOxwvtSwMAFUQ7nklHKE7kmPLvqPQLRSK','Mon, 06 May 2019 00:30:29 +0000');
SET @PersonID = LAST_INSERT_ID();
insert into faculty (ID, department) values (@PersonID,'ME');
insert into EquipmentBelongsTo (equipmentID, userID) values (@EquipmentID,@PersonID);
insert into project (startDate, endDate, leadID, name) values ('Mon, 06 May 2019 00:30:29 +0000','Mon, 06 May 2019 00:30:29 +0000',@PersonID,'XJLPGOSX');
SET @ProjectID = LAST_INSERT_ID();
insert into worksOn (UserID, ProjectID) values (@PersonID,@ProjectID);
insert into person (username, passwordHash, joined) values ('MQK[ETDK','$2b$12$RwBlhK/a6/OgUOup7AHyQOne4jAfI/ZnGtia3fQV0XkQyvfDzl9TW','Mon, 06 May 2019 00:30:29 +0000');
SET @PersonID = LAST_INSERT_ID();
insert into student (ID, major, classification) values (@PersonID,'ME',1);
insert into worksOn (UserID, ProjectID) values (@PersonID,@ProjectID);
insert into experiment (ProjectID, startDate, category) values (@ProjectID,'Mon, 06 May 2019 00:30:29 +0000',0);
SET @ExperimentNo = LAST_INSERT_ID();
insert into experimentusesenvironment values (@ProjectID,@ExperimentID,@EnvironmentID);
insert into agentparticipates (projectID,experimentNo,agentID) values (@ProjectID,@ExperimentNo,@AgentID);
insert into result (ProjectID,experimentNo,completed,path) values (@ProjectID,@ExperimentNo,FALSE,'YLLIJCSHSRLWNPTTTW[LQKJTNNWRVNCKYLLLBK[UCUHIXS[ILRKGQZMDSXDJJNDQHACMHFLQKFVPDUJEXKYNNDSCYOJQFEACGSRCOJZJTZQRONX[UCBMWQDZVKJJXITNTCPVNANPATSTBWIOSMUKKBDMBSAFLXADNEVVNOGQGSRWNAHUWIHSCGIUQXUHNWRCRYKPLUCLVOADNVKTYEGQYNMDVBBOXSNOWRFAGPHUQZJCSPPRG[UECJZQPBSZGZQN');
insert into environment (name,rewardLow,rewardHigh,path) values ('GRHFEWLIVMDUOCUEZNNNLIYTTAHABPQJ',0.589972,1.229594,'ZDGSDVZXZHBVVKIPFXEHNJHCVHDFSETKOEB[WWFEQNEKIHAMYM[MCKOAZVQLKYOQJNPQAENSSTEIGYEPDEDGAZKMPPHSRTHICRLZAFDWHR[IQYUEUJBMIEFYPFIPGPKEYHYTLZSFUFRNJZPRZCVQBSEOBGDEDSYNNDQAFVXCHJRPFUKNCFYM[CRQAXCDLXOXAVLZMMQIANOJ[BHJDQCCTUFSNTQZAT[KHLTOYSSPFFSDKKAUBQGNGNZVNQEAPTRQ');
SET @EnvironmentID = LAST_INSERT_ID();
insert into environmenthasspace values (@EnvironmentID,'QAMXXXXKC[NZCFVNSELOSVOUTZEDYSEEHNKYQGLISVCCVOMJRCODIPFTJOPAYCZX',1);
insert into equipment (name, category, location) values ('CW[N[LTZSBZHDUUGPKAXHQQVEWJXYLWT',0,'XTCEFETUKFPTNQCE[QPJRWZHNBDYAMUO');
SET @EquipmentID = LAST_INSERT_ID();
insert into model (name, category, path) values ('YTRKWCOVFMVMDXVVJPSVQIZ[ASONLIPQ',0,'TQWZVP[CCRDHERVA[ZMTMOTEHTBYOLWLSUJEIBFYYVKXKACOO[TSBWXWVBCWZBUFCPR[JZJVPUSNQQWRIYAFCPVVMBWMRXLY[FMPTNBVHMDX[DK[[UZWZEOBVBJJUKLYUVEVENZQBSQLRBKATSJKKKSSPQDOCGDS[IZHR[SZDQFSKMAWLEJCJGLEFHCJZBMBYBVCNKFXIKLWBULXWWPN[JDUG[[IXYOLRQWNDTXVZPQTDAKHWTYXSEJOYLTJSVZD');
SET @ModelID = LAST_INSERT_ID();
insert into agent (actionspace, observationspace, path) values ('V[NTZKDOZEWCUGGXVUNUTASSPJYQKTGI','ULMOTDXQJYGEDGOHIXY[ZVVYPBQQZCAA','HMQTRQZTTGPFXHL[CIAEQQKJIFHMYRGFNGFLFUFAZOJXZNZUSYTYAQGYNEYEOJLSBJWXQZPNUFXI[CMMYPSTFJFAILIJQSOVGLHSDYBKY[XDZBZWQLCOSFMIVSSKUCJQPHIHABAKHVMFAKOQDDZJXRQJRYETSYFJCRVFQECDA[AYUT[LGQWAKVUTMKWIQGJUCFNDWQYVLRGLTJUYFNXPINBPJNKEONTAW[HDELIYCSDSMSUDBZFDNIMHINRWCQUH');
SET @AgentID = LAST_INSERT_ID();
insert into agentUsesModel (agentID, modelID) values (@AgentID,@ModelID);
insert into person (username, passwordHash, joined) values ('KABMPYEA','$2b$12$UIVvKAqDAKbYmcHa3EStwObbQ63j7vaVNmM.XV7qoIZD6q2Hoz/dW','Mon, 06 May 2019 00:30:29 +0000');
SET @PersonID = LAST_INSERT_ID();
insert into faculty (ID, department) values (@PersonID,'EE');
insert into EquipmentBelongsTo (equipmentID, userID) values (@EquipmentID,@PersonID);
insert into project (startDate, endDate, leadID, name) values ('Mon, 06 May 2019 00:30:29 +0000','Mon, 06 May 2019 00:30:29 +0000',@PersonID,'YXNPHWLQ');
SET @ProjectID = LAST_INSERT_ID();
insert into worksOn (UserID, ProjectID) values (@PersonID,@ProjectID);
insert into person (username, passwordHash, joined) values ('ONTADVTA','$2b$12$Nn1on1OAZpCR5.xxUTCIg.HYyZzJB0YWKWXwVY82ELpgKnfqVSlnu','Mon, 06 May 2019 00:30:29 +0000');
SET @PersonID = LAST_INSERT_ID();
insert into student (ID, major, classification) values (@PersonID,'CSCI',5);
insert into worksOn (UserID, ProjectID) values (@PersonID,@ProjectID);
insert into experiment (ProjectID, startDate, category) values (@ProjectID,'Mon, 06 May 2019 00:30:29 +0000',0);
SET @ExperimentNo = LAST_INSERT_ID();
insert into experimentusesenvironment values (@ProjectID,@ExperimentID,@EnvironmentID);
insert into agentparticipates (projectID,experimentNo,agentID) values (@ProjectID,@ExperimentNo,@AgentID);
insert into result (ProjectID,experimentNo,completed,path) values (@ProjectID,@ExperimentNo,FALSE,'WWDNENTSEMHUQBHGLHKUSSWXRSTEKKHTELSUHII[LPOR[RTLILXHMWRXZXIWPKE[XCYVAGE[HRYPJUOTSIFIHIDJCSNADBXAOHA[NAHNTCNIQMUVDUKHMLZQWMEKIWHUNDPUDFVXVDQUFNBZLKYHYENGRAHEMW[HGUWQKIJULIFFXQRMUJXVXJYFBUTJ[CHUSRRWGBGNVE[K[[UIMJQFTQK[FOJWOJW[BLVTXOCBYOPAAXPSDBLLUOWDYBDMFF[R');
insert into environment (name,rewardLow,rewardHigh,path) values ('CTBCSDNSHJMJNFLCANR[BFBUEERBMAH[',0.815163,1.376139,'ULXUSLLVLTWJVLYYE[LWDAYYFWHWXNBG[LKEY[[RMTSXIEOKOXB[UPNMDHENMSGERFTBCHXYQEMVLS[YAYKVZNMVTBTGKJGZUTEAGDZXQBDNVKPOL[GILOPH[SBQKHKEQGGXHEDBFLMJCOUQRBAQMZQLYSHOMPMMNMSLPND[GMZFOJCAGTNQLVFWORFBEBN[NJDJUICEWJMALPNZJQMPAGQJHBOWCSYPUWPP[KOCGMMWJYGWLKSSABYJYBMFRGSR');
SET @EnvironmentID = LAST_INSERT_ID();
insert into environmenthasspace values (@EnvironmentID,'KORONZJPIYTXDQFEDQLLIKEWEVQVWDM[OVEXNVRR[YKQFGBJVZKAONNRGYGT[JLC',1);
insert into equipment (name, category, location) values ('FCULMHAMXDDNYIMWYXCDLTVDUOQUEZWM',0,'[PTBJAEJHYXLDSBJHNMCOLZCE[NXSBTR');
SET @EquipmentID = LAST_INSERT_ID();
insert into model (name, category, path) values ('CFAUNWZRCNBXGLSRJTEHTWIVKL[FQKBE',0,'Q[UFJWGLKVUCXMULSPQWEEECFQSXNW[OSHSLM[XOWPOTKAOHIMXQGYQRLWL[RDNXHJXGKARZQQHHFHTES[ILW[NLZTTJELQLEJMDHBAHGUDNVNG[MQTHFF[EBLVFKHSZWSJHEVTICYYJWPIXOEIUZELC[QSHKAMHFX[SQHJTKIRLBEVPZIDLINYYMYPOBCUBDILVBLPFOYCAKVDTLVTXCGFSFUPJXGEGWWHHRJCBHSFIZMLZFOAY[WDPCD[RWGGZ');
SET @ModelID = LAST_INSERT_ID();
insert into agent (actionspace, observationspace, path) values ('NSIHRCIRBPQ[BLEOYAKQIMHGDKIXS[EX','RBPEXWD[GRL[RSEATKRVFWRIYEHJTHO[','ESFYEUHTOIYLFSNFSVNHNRKTPCHBFXRELWGI[WUF[JAEUDONFEN[DAGSFJWGAFOFYBHGJLNVKB[IBXUGOLDNZUPPCDM[HAP[ZZVFDIEGQCNUQVWOCJIVDXSLFLEKRPGPMELJUHUNUZOIDMWVU[WFRVRR[APAXBEHADYGXJNYSYAYVOQDPBYAQSDQURCFLGZFZV[MSMXUMOJQNSHQJIGOXMW[HOHZEZDJUQ[EMTC[OJSXRIFMSEABAWQKFOHCNOGU');
SET @AgentID = LAST_INSERT_ID();
insert into agentUsesModel (agentID, modelID) values (@AgentID,@ModelID);
insert into person (username, passwordHash, joined) values ('LLGBWQLC','$2b$12$F7xUzmmvsF0ZgRQON/Lvi.UM9j67VE8nW/Vu.TH4b2Bbsl39IFJQa','Mon, 06 May 2019 00:30:30 +0000');
SET @PersonID = LAST_INSERT_ID();
insert into faculty (ID, department) values (@PersonID,'ME');
insert into EquipmentBelongsTo (equipmentID, userID) values (@EquipmentID,@PersonID);
insert into project (startDate, endDate, leadID, name) values ('Mon, 06 May 2019 00:30:30 +0000','Mon, 06 May 2019 00:30:30 +0000',@PersonID,'QWLGIRHA');
SET @ProjectID = LAST_INSERT_ID();
insert into worksOn (UserID, ProjectID) values (@PersonID,@ProjectID);
insert into person (username, passwordHash, joined) values ('XLOBOALZ','$2b$12$3uXfiNgWd9d2YNg55DHJjuhDSM0opphWmul8WqrEtR4dwGDu7sare','Mon, 06 May 2019 00:30:30 +0000');
SET @PersonID = LAST_INSERT_ID();
insert into student (ID, major, classification) values (@PersonID,'EE',2);
insert into worksOn (UserID, ProjectID) values (@PersonID,@ProjectID);
insert into experiment (ProjectID, startDate, category) values (@ProjectID,'Mon, 06 May 2019 00:30:30 +0000',0);
SET @ExperimentNo = LAST_INSERT_ID();
insert into experimentusesenvironment values (@ProjectID,@ExperimentID,@EnvironmentID);
insert into agentparticipates (projectID,experimentNo,agentID) values (@ProjectID,@ExperimentNo,@AgentID);
insert into result (ProjectID,experimentNo,completed,path) values (@ProjectID,@ExperimentNo,FALSE,'[[MZLSWZRKMJPNHNETX[VDFGNOLYSQABXFUNNYNY[FVMQWV[FUPLMTWBDTKAPUUXACOBFWNIQWZDXFHYVWUBYRLUJKIXBCOUIOJREKTKGQAGLEFC[QCFABJ[OXJAWVIGBYDCQOIPEJHIAOVXECZSYIDEEQKNUTKBAMTPZHEMRKMEQKUATFGJ[VZGDYO[NMMZPXRPTTSDQCUJILPWIIZBXCPMIZSSDBSOJWSCBGZHUDUUCNHNPVSFRKYAYVAUKJBA');
insert into environment (name,rewardLow,rewardHigh,path) values ('UTIIOVUILVEUYFKRJSJVAZRCHVXNVHXG',0.759003,0.836506,'HSUQJKGMFOKEL[FAXAEZUUUVWBPUCWNWYDIXXISMOJTRKILRWEEKJT[SNBVOFUIFBUH[EOMUKQ[FNXBERYW[IC[RKBUOTSGCZTFJWQDYIKYKLVWCUZMKAWHIISQJMMWAYD[NHLKFOFCRZOEURKEPTI[QIMSCN[FFQSRRHRONUNWDOGKMGCUJVVPRPMIJSPBLEHJIRTCKSKPGR[ENNOBKQCQXAMLA[KXMAGWSXOPZGYR[ZUB[OITDQKZBJSUQSOFP');
SET @EnvironmentID = LAST_INSERT_ID();
insert into environmenthasspace values (@EnvironmentID,'YS[GNMUYQXDHMH[DYVHRZYFTX[VBAPHLBGHAVJZGHYSOPHJUKVIBNCL[ZYCJNVGS',1);
insert into equipment (name, category, location) values ('DB[NSKNABAHPXOUZUGFHPCDZMIUFNJBW',0,'ALKRREOVLUOLXJFAXZCWLYBQISCBSCED');
SET @EquipmentID = LAST_INSERT_ID();
insert into model (name, category, path) values ('JGNOBNQNOWGDOJVFAOMSR[ILQNARCCPI',0,'FGNSCQJHKBAKLUFSVCQLPCEXOEVKJPIERVZUTZWWIZZUQJBHRXGMCDAZXIYJFJKLSIGMVQMEQE[NTQUICMRVZUUNPXYVLMN[XKJQRWVPYDMHQSWWLDQJBCXSWFKHRZRRJVDATUYECSR[Z[EYH[UMJEHDX[SKABACPNYWWWRTRZLWVFVFLHZBBXMPSFIWUPGNLGIUSZVKSDHTZCCLEZRBPRXJBTJXCNBHCWMGNUMO[VNEKKCXTDQFZFHQ[[CCLIPB');
SET @ModelID = LAST_INSERT_ID();
insert into agent (actionspace, observationspace, path) values ('SOOBKFOVWSWYZGYLEIUSTBSBRSWZRWHZ','VWRLRKNRWQYVNOLQNOFCFJ[LJXJHOXZW','MWLRXRMRQVAHWKIXDHOC[NNWASUQCFKFQWCNO[DWPFDOZQHAPUROERXDLMHGUR[B[YBQXNUUXTTKCPR[OHQYOGLOHFNANIGERWOHIXEERUMBYVBTEDFC[ZH[RPPIXHKLDVLAEOJQDBTFPWGOUTMOZZAEVPGMQ[VMJDLHGOHCEPVXRRMAIFOAQDAYYYAVHVSRYUKGTUCBELIIYJQSTONIAGOTSQFRFA[RZHLQSRWCHCVRMFPN[ZMJYKKVQMNWOUSJ');
SET @AgentID = LAST_INSERT_ID();
insert into agentUsesModel (agentID, modelID) values (@AgentID,@ModelID);
insert into person (username, passwordHash, joined) values ('LNBMCNK[','$2b$12$yj.IaYr3PGlonwJRXIlvludwaoTeI5XTVvybtMRB0prwMqNahr8MK','Mon, 06 May 2019 00:30:30 +0000');
SET @PersonID = LAST_INSERT_ID();
insert into faculty (ID, department) values (@PersonID,'CSCI');
insert into EquipmentBelongsTo (equipmentID, userID) values (@EquipmentID,@PersonID);
insert into project (startDate, endDate, leadID, name) values ('Mon, 06 May 2019 00:30:30 +0000','Mon, 06 May 2019 00:30:30 +0000',@PersonID,'XEAKOXWN');
SET @ProjectID = LAST_INSERT_ID();
insert into worksOn (UserID, ProjectID) values (@PersonID,@ProjectID);
insert into person (username, passwordHash, joined) values ('HOYXQFPZ','$2b$12$5zv8qUrlx8Ql4SakokjPnujTkH1p/yU5Jf/7UlocdM.gK5oYPrGoa','Mon, 06 May 2019 00:30:30 +0000');
SET @PersonID = LAST_INSERT_ID();
insert into student (ID, major, classification) values (@PersonID,'EE',5);
insert into worksOn (UserID, ProjectID) values (@PersonID,@ProjectID);
insert into experiment (ProjectID, startDate, category) values (@ProjectID,'Mon, 06 May 2019 00:30:30 +0000',0);
SET @ExperimentNo = LAST_INSERT_ID();
insert into experimentusesenvironment values (@ProjectID,@ExperimentID,@EnvironmentID);
insert into agentparticipates (projectID,experimentNo,agentID) values (@ProjectID,@ExperimentNo,@AgentID);
insert into result (ProjectID,experimentNo,completed,path) values (@ProjectID,@ExperimentNo,FALSE,'EGRQNVKBKVFMAHHFIPQWNTOEYJYEBFJXFIYBTWRESLPRQRFAJLPVRRXQMPDWRIGBUWIWUKIUHRY[EDDG[CHBMVN[TXNYKS[CXFQDLGVRNYPKNXQQCTJXEBSBLWYLYQD[UJSFCDNPLM[FBORYNLFIOJERYKFSQPQMCCFBUSSSHPNCCBEBSINDBKBAIEMNCSFQEUJKTJ[IYWAOUIJAXHTTGIPWCFNRGABEVDKBTRIZKEEFMCKBZKXFCLJHTXBJGWEA');