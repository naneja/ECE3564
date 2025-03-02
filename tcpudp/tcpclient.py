from socket import *

clientSocket = socket(AF_INET, SOCK_STREAM)
clientSocket.connect(("161.35.59.112", 14000))

sentence = input("Input lowercase sentence: ")

clientSocket.send(sentence.encode())

modifiedSentence = clientSocket.recv(1024)
print("From Server: ", modifiedSentence.decode())

clientSocket.close()